<?php
/**
 * register actions.
 *
 * @package    rayku
 * @subpackage register
 * @author     lala
 */
class registerActions extends sfActions
{
    public function preExecute()
    {
    	$this->ref = (isset($_GET['ref'])) ? $_GET['ref'] : NULL; 
        RaykuCommon::getDatabaseConnection();
    }

    /**
     * Action to show the registration form
     */
    public function executeIndex()
    {
    	die(__LINE__.' '.__FILE__);
        //If the user is logged in, don't let them register
        if ($this->getUser()->isAuthenticated()) {
            $this->error = 'You are already logged in. You can not register again.';
            return sfView::ERROR;
        }

        $this->requestedUserType = $this->getRequestedUserType();

        //If the form hasn't yet been filled in, just display the form
        if (sfWebRequest::POST !== $this->getRequest()->getMethod()) {
            return sfView::SUCCESS;
        }

        if ($this->getRequestParameter('terms') != 1) {
            $this->error = 'You must agree to our <strong>Terms & Conditions</strong>. <a href="#" onClick="javascript: history.go(-1)">Click here</a> to go back to the previous page.';
            return sfView::ERROR;
        }

        //Create and populate the User object
        $user = new User();
        $user->setEmail($this->getRequestParameter('email'));
        $user->setPassword($this->getRequestParameter('password1'));
        $user->setName($this->getRequestParameter('realname'));

        $expiration = substr($this->getRequestParameter('expiry_date'),0,2) .'/'. substr($this->getRequestParameter('expiry_date'),-2);

        require_once ($_SERVER['DOCUMENT_ROOT'].'/braintree_environment.php');

        $result = Braintree_Customer::create(array(
            'firstName' => $this->getRequestParameter('realname'),
            'lastName' => '',
            'creditCard' => array(
                'cardholderName' => $this->getRequestParameter('realname'),
                'number' => $this->getRequestParameter('credit_card'),
                'cvv' => $this->getRequestParameter('cvv'),
                'expirationDate' => $expiration,
                'options' => array(
                    'verifyCard' => true
                )
            )
        ));

        //error_log($result->customer->creditCards[0]->token, 0);


        if (false && !$result->success){
            //error_log("invalid", 0);
            $this->error = 'Your credit card is invalid.';
            return sfView::ERROR;


        }else{
            //should only save last 4 digit
//            $user->setCreditCard(substr($this->getRequestParameter('credit_card'),-4));
//            $user->setCreditCardToken($result->customer->creditCards[0]->token);

            $userName = str_replace(' ','',strtolower($this->getRequestParameter('realname')));
            $U_QRY = "select * from user where username='".$userName."'";
            $u_res = mysql_query($U_QRY);
            $unamecount = mysql_num_rows($u_res);

            $dupval = 2;
            duplicationCheck:
                if ($unamecount>=1) {
                    $newUsername = $userName.$dupval;
                    $unamequery = mysql_query("select * from user where username='".$newUsername."'");
                    $unamecount = mysql_num_rows($unamequery);
                    if ($unamecount>=1) {
                        $dupval++;
                        goto duplicationCheck;
                    } else {
                        $userName = $newUsername;
                    }
                }
            $user->setUsername($userName);
            $user->setTypeUnconfirmed($this->requestedUserType);


            if (!empty($_POST['coupon'])) {
                $query = mysql_query("select * from referral_code where referral_code='".$_POST['coupon']."'") or die(mysql_error());

                if (mysql_num_rows($query) > 0) {
                    $rowValues = mysql_fetch_assoc($query);	//$rowValues['user_id'];
                    $query = mysql_query("select * from user where id=".$rowValues['user_id']) or die(mysql_error());
                    $rowDetails = mysql_fetch_assoc($query);
                    $newPoints = $rowDetails['points'] + 0.5;
                    mysql_query("update user set points='".$newPoints."' where id=".$rowValues['user_id']) or die(mysql_error());
                    mysql_query("delete from referral_code where referral_code='".$_POST['coupon']."'") or die(mysql_error());
                } else {
                    if ($_POST['coupon'] == 'launch11') {
                        $points = "10";
                    } elseif ($_POST['coupon'] == 'promo92') {
                        $points = "12";
                    } elseif ($_POST['coupon'] == 'uoft9211') {
                        $points = "8";
                    }
                }
            }


            if (!$user->save()) {
                throw new PropelException('User creation failed');
            }

            if ($this->requestedUserType == UserPeer::getTypeFromValue('expert')) {
                $this->notify = $this->getRequestParameter('notify_email').','.$this->getRequestParameter('notify_sms');
                $user->setNotification($this->notify);
                $user->setPhoneNumber($this->getRequestParameter('phone_number'));
                $this->subscribeExpertToCategories($this->getRequestParameter('categories'), $user);
            }

            if (!empty($_POST['coupon']) && !empty($points)) {
                mysql_query("update user set points='".$points."' where id=".$user->getId()) or die(mysql_error());
            } elseif (!empty($_POST['coupon'])) {
                mysql_query("update user set points='1000' where id=".$user->getId()) or die(mysql_error());
            }

			// Referral module
			// Rajesh Soni - 23 November 2012

            if (isset($_POST['ref']))
			{
				$ref_by_user = mysql_real_escape_string( $_POST['ref'] );
                mysql_query("update user set referred_by='$ref_by_user' where id=".$user->getId()) or die(mysql_error());
			}else {
                mysql_query("update user set referred_by='0' where id=".$user->getId()) or die(mysql_error());

            }

            mysql_query("insert into expert_category(user_id,category_id) values('".$user->getId()."','1')") or die(mysql_error());
            mysql_query("insert into user_score(user_id,score) values('".$user->getId()."','1')") or die(mysql_error());

            $this->sendConfirmationEmail($user);
            //;
            $email_param=$user->getEmail();
            $this->getRequest()->setParameter('email', $email_param);
            $this->forward('register','confirmationCodeSent');
        }
    }

    private function getRequestedUserType()
    {
        $allowedTypes = array(
            UserPeer::getTypeFromValue('user'),
            UserPeer::getTypeFromValue('expert')
        );

        $requestedType = $this->getRequestParameter('utype');

        if (in_array($requestedType, $allowedTypes)) {

            return $requestedType;
        }
        return UserPeer::getTypeFromValue('user');
    }

    private function subscribeExpertToCategories($categories, User $user)
    {
        if (!is_array($categories)) {
            return;
        }

        foreach($categories as $categoryid) {
            $category = CategoryPeer::retrieveByPK($categoryid);
            if (!$category) {
                continue;
            }

            $expertcat = new ExpertCategory();
            $expertcat->setUser($user);
            $expertcat->setCategory($category);
            $expertcat->save();

        }
    }

    private function sendConfirmationEmail(User $user)
    {
    	StatsD::increment('signup');
        $mail = Mailman::createMailer();
        $mail->setContentType('text/html');
        $mail->addAddress($user->getEmail());
        $mail->setSubject('Confirm your Rayku Account');
        sfProjectConfiguration::getActive()->loadHelpers(array('Asset','Url','Partial'));
        $mail->setBody(
            get_partial(
                'activationEmailHtml',
                array('activationLink' => url_for('@register_confirm?code='.$user->getConfirmationCode(), true),
                'user' => $user)));
        $mail->setAltBody(
            get_partial(
                'activationEmail',
                array('activationLink' => url_for('@register_confirm?code='.$user->getConfirmationCode(), true),
                'user' => $user)));
        $mail->send();
    }

    /**
     * Handles validaton errors in the register form... passes the user back
     * to the form where the errors are displayed.
     */
    public function handleErrorIndex()
    {
        $this->requestedUserType = $this->getRequestedUserType();
        return sfView::SUCCESS;
    }

    /**
     * Action to handle getting a confirmation code. Confirms user and spits out
     * a success page if the code checks out... spits out an error page otherwise
     */
    public function executeConfirmUser()
    {

        if (strlen($this->getRequestParameter('code')) > 40) {
            $req = unserialize(base64_decode(urldecode($this->getRequestParameter('code'))));
            $code = $req['code'];
            $question = $req['question'];
        } else {
            $code = $this->getRequestParameter('code');
        }

        $user = UserPeer::doSelectFromConfirmationCode($code);

        if (!$user) {
            $newCode = $this->getRequestParameter('code');
            $oC = new Criteria();
            $oC->add(UserPeer::ID, "SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$code'" , Criteria::CUSTOM);
            $oC->add(UserPeer::TYPE, '1');
            $userCheck = UserPeer::doSelectOne($oC);
            if (!$userCheck) {
                return sfView::ERROR;
            }
        }

        if ($user) {
            $user->setTypeConfirmed();
            $user->save();



			// Referral module
			// Rajesh Soni - 23 November 2012

			$ref_points = 6;
			$ref_points_user = 4;

			$sql2 = "select referred_by from user where id=".$user->getId();


			if( $user->getId() )
			{
				$result = mysql_query( $sql2 ) or die( $sql2 . mysql_error());
				$row = mysql_fetch_row($result) or die( $sql2 . mysql_error());

				$ref_by_user = $row[0];

				if ($ref_by_user)
				{
					$sql2 = "update user set points= points + ".$ref_points." where id=".$ref_by_user . " LIMIT 1";
					mysql_query( $sql2 ) or die( $sql2 . mysql_error());

					$sql2 = "update user set points='".$ref_points_user."' where id=".$user->getId() . " LIMIT 1";
					mysql_query( $sql2 ) or die( $sql2 . mysql_error());
				}
			}


        }

        if ($user) {
            $this->getUser()->signIn($user);
        } else {
            $this->getUser()->signIn($userCheck);
        }

        if ($question) {
            $this->getRequest()->setParameter('question', $question);

			// Rajesh Soni - 28 November 2012

            $this->redirect("/referrals?register=success");

        } elseif ($user) {

			// Rajesh Soni - 28 November 2012

            $this->redirect("/referrals?register=success");

        } else {
            $this->redirect("/referrals?register=success");
        }
    }

    /**
     * Action to show the page that says "The confirmation code has been sent to
     * your e-mail address."
     */
    public function executeConfirmationCodeSent()
    {
        $this->email_param=$this->getRequest()->getParameter('email');
    }

    public function executeRedirect()
    {
        $user = $this->getUser()->getRaykuUser();
        $query = mysql_query("select * from user_expert where user_id=".$user->getId()) or die(mysql_error());
        $chat_query = mysql_query("select * from sendmessage where asker_id=".$user->getId()) or die(mysql_error());
        $expertResponse = mysql_num_rows($query);
        $chatResponse = mysql_num_rows($chat_query);

        if (empty($chatResponse) && empty($expertResponse)) {
            if (!empty($_COOKIE['redirection'])) {
                $redirectvalue = "redirect";
                echo $redirectvalue;
            }
        }
        exit(0);
    }

    public function executeConfirmationEmailResend($request)
    {
        $email=$request->getParameter('email');
        $c=new Criteria();
        $c->add(UserPeer::EMAIL,$email);
        $user = UserPeer::doSelectOne($c);
        $this->sendConfirmationEmail($user);
        $this->getRequest()->setParameter('email', $email);
        $this->forward('register', 'confirmationCodeSent');
    }
}
