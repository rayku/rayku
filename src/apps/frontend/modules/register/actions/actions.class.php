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
        RaykuCommon::getDatabaseConnection();
    }

    /**
     * Action to show the registration form
     */
    public function executeIndex()
    {
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
        
        
        if (!$result->success){
            //error_log("invalid", 0);
            $this->error = 'Your credit card is invalid.';
            return sfView::ERROR;
            
            
        }else{
            //should only save last 4 digit
            $user->setCreditCard(substr($this->getRequestParameter('credit_card'),-4));
            $user->setCreditCardToken($result->customer->creditCards[0]->token);

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
                mysql_query("update user set points='11' where id=".$user->getId()) or die(mysql_error());
            }
            mysql_query("insert into expert_category(user_id,category_id) values('".$user->getId()."','1')") or die(mysql_error());
            mysql_query("insert into user_score(user_id,score) values('".$user->getId()."','1')") or die(mysql_error());

            $this->sendConfirmationEmail($user);

            $this->forward('register', 'confirmationCodeSent');
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
        $user = UserPeer::doSelectFromConfirmationCode($this->getRequestParameter('code'));

        if (!$user) {
            $newCode = $this->getRequestParameter('code');
            $oC = new Criteria();
            $oC->add(UserPeer::ID, "SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$newCode'" , Criteria::CUSTOM);
            $oC->add(UserPeer::TYPE, '1');
            $userCheck = UserPeer::doSelectOne($oC);
            if (!$userCheck) {
                return sfView::ERROR;
            }
        }

        if ($user) {
            $user->setTypeConfirmed();
            $user->save();
        }

        if ($user) {
            $this->getUser()->signIn($user);
        } else {
            $this->getUser()->signIn($userCheck);
        }
        if ($user) {
            $this->forward('register', 'new');
        } else {
            $this->redirect("/dashboard/getstarted");
        }
    }

    public function executeNew()
    {
    }

    public function executeOther()
    {
    }

    /**
     * Action to show the page that says "The confirmation code has been sent to
     * your e-mail address."
     */
    public function executeConfirmationCodeSent()
    {
    }

    /**
     * Action to Send the invitation
     */
    public function executeSendInvitation()
    {
        $user = $this->getUser()->getRaykuUser();
        $this->mail = Mailman::createCleanMailer();
        $this->mail->setSubject('Rayku.com Coupon Credit');
        $this->mail->setFrom($user->getName().' <'.$user->getEmail().'>');

        $list=$this->getRequestParameter('list');

        $j = 1;
        $date = date("Y-m-d");

        if ($user) {
            foreach($list as $name_email) {
                $user->sendPointsFromAdmin(sfConfig::get('app_general_invite_points'));
                list($to,$name) = @split('x22z',$name_email);

                if (ereg('@',$name)){
                    $name = "";
                }

                if ($to) {

                    $refcode = $user->getUsername()."-".crypt($user->getUsername().$j,md5($user->getUsername().$j.time()));
                    mysql_query("insert into referral_code(user_id, referral_code, date) values(".$user->getId().", '".$refcode."', '".$date."') ") or die(mysql_error());
                    sfProjectConfiguration::getActive()->loadHelpers(array('Partial'));
                    $this->mail->setBody("<p>".$user->getName()." has given you coupon credit through Rayku.com.</p><p>Value of Coupon: <strong>5.5 Rayku Points</strong> ($5.50 Canadian Dollars)<br />Eligibility: <strong>University of Toronto Students</strong><br />Expiration Date: <strong>xx/xx/2011</strong><br />Unique Coupon Code: <b>".$refcode."</b></p>". get_partial('invitationEmailHtml', array('name' => $name, 'user' => $user)));

                    $this->mail->setContentType('text/html');
                    $this->mail->addAddress($to);
                    $this->mail->send();
                    $j++;
                }
            }
        }
        $this->redirect('@register_step4');
    }

    public function executeInvitation()
    {
        $user = $this->getUser()->getRaykuUser();
        $this->user = $user;
        $username = $user->getUsername();
        $date = date("Y-m-d");
        if (!empty($_POST)) {
            for($i=0; $i < 5; $i++) {
                if ($user<>''){
                    $refcode=$user->getUsername()."-".crypt($username.$i,md5($username.$i.time()));
                    mysql_query("insert into referral_code(user_id, referral_code, date) values(".$user->getId().", '".$refcode."', '".$date."') ") or die(mysql_error());
                }
            }

            $this->flag = 1;
        }
    }

    /**
     * show the latest user header
     */
    public function executeLatestUserHeader()
    {
        sfProjectConfiguration::getActive()->loadHelpers('Partial');

        $user = $this->getUser()->getRaykuUser();

        if ($user->getPoints() < 2) {
            $query = mysql_query("select * from points_notify where userid=".$user->getId()) or die(mysql_error());

            if (mysql_num_rows($query) == 0) {

                $this->mail = Mailman::createCleanMailer();
                $this->mail->setSubject('Rayku Points - Almost used up!');
                $this->mail->setFrom('Bonnie Pang <bonniecs@rayku.com>');
                $to = $user->getEmail();

                $this->mail->setBody("<p>Hi there,<br /><br />I've noticed that your Rayku \$RP balance has just fallen below 2$RP. I really hope you've spent them well!<br /><br />In order to get more Rayku Points, here's two quick & instant options: <br /><a href='/shop/paypal'><strong>Buy Rayku Points</strong></a><br /><a href='/register/invitation'><strong>Invite Your Friends (get \$RP)</strong></a><br /><br />Or, if you need help with any of those two options I listed above, just send me a reply and I'll do my best to help you out!<br /><br />Thanks for using Rayku.com!<br />Bonnie Pang<br />Rayku Account Rep<br /><br />http://www.rayku.com</p>");

                $this->mail->setContentType('text/html');
                $this->mail->addAddress($to);
                $this->mail->send();

                mysql_query("insert into points_notify(userid,status) values(".$user->getId().", 1)") or die(mysql_error());
            }
        } else {
            mysql_query("delete from points_notify where userid=".$user->getId()) or die(mysql_error());
        }
        return $this->renderText(get_partial('topNavNewUser'));
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
}