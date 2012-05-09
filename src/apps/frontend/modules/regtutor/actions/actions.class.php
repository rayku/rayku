<?php
/**
 * regtutor actions.
 *
 * @package    rayku
 * @subpackage regtutor
 * @author     lala
 */
class regtutorActions extends sfActions
{
    public function preExecute() {
        RaykuCommon::getDatabaseConnection();
    }

    /**
     * Action to show the registration form
     */
    public function executeIndex()
    {
        //If the user is logged in, don't let them regtutor
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

        // GENERATE USERNAME FROM FULL NAME FIELD

        $userName = str_replace(' ', '', strtolower($this->getRequestParameter('realname')));
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

        if (!$user->save()) {
            throw new PropelException('User creation failed');
        }
        $uptSQL = "UPDATE user SET where_find_us='".$this->getRequestParameter('where_find_us')."' WHERE id='".$user->getId()."'";
        mysql_query($uptSQL);

        if ($this->requestedUserType == UserPeer::getTypeFromValue('expert')) {
            $this->notify=$this->getRequestParameter('notify_email').','.$this->getRequestParameter('notify_sms');
            $user->setNotification($this->notify);
            $user->setPhoneNumber($this->getRequestParameter('phone_number'));
            $this->subscribeExpertToCategories($this->getRequestParameter('categories'), $user);
        }

        mysql_query("insert into expert_category(user_id,category_id) values('".$user->getId()."','1')") or die(mysql_error());
        mysql_query("insert into user_score(user_id,score) values('".$user->getId()."','1')") or die(mysql_error());
        $this->sendConfirmationEmail($user);
        $this->forward('regtutor', 'confirmationCodeSent');
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
                array('activationLink' => url_for('@regtutor_confirm?code='.$user->getConfirmationCode(), true),
                'user' => $user)));
        $mail->setAltBody(
            get_partial(
                'activationEmail',
                array('activationLink' => url_for('@regtutor_confirm?code='.$user->getConfirmationCode(), true),
                'user' => $user)));
        $mail->send();
    }

    /**
     * Handles validaton errors in the regtutor form... passes the user back
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
            $oC->add(UserPeer::ID, "SHA1(CONCAT(user.password, 'salt', user.id)) = '$newCode'" , Criteria::CUSTOM);
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
        if ($kinkarsoUser) {
            if ($user) {
                $query = mysql_query("select * from  shout where recipient_id=".$user->getId()." and  poster_id=".$kinkarsoUser->getId()."") or die(mysql_error());
                if (mysql_num_rows($query) == 0) {
                    ShoutPeer::createWelcomeComment($user,$kinkarsoUser);
                }
            }

            $subject='Here\'s how to start tutoring on Rayku';
            if ($user) {
                $body='Hey '.$user->getName().', welcome to Rayku.com!<br><br>';
            }
            $body .='Thanks for joining our community!<br><br>

                Before you get started, there are 3 important steps before you can start tutoring!<br><br>
                1) Activated your tutor status by clicking \'on\' in your <a href="http://rayku.com/dashboard">dashboard page</a>.<br>
                2) Important: Learn how to tutor on Rayku in 10 minutes by watching our <a href="http://rayku.com/tutorshelp">tutor help videos</a>.<br>
                3) Prepare to receive question notifications by connecting to our <strong><a href="http://notification-bot.rayku.com/download/rayku.dmg">MacOS</a> / <a href="http://notification-bot.rayku.com/download/rayku.exe">Windows</a> notification software</strong>, <a href="http://rayku.com/dashboard/gtalk">google talk</a> and <a href="http://rayku.com/dashboard/facebook">facebook chat</a>.<br><br>

                Enjoy, and do let us know if you ever have any questions - we\'re here to help!<br><br>

                Thanks!<br>
                Rayku Administration';
            $currentuser = $kinkarsoUser;
            //Send the message

            if ($user) {
                $currentuser->sendMessage($user->getId(),$subject,$body);
            }
        }

        $this->forward('regtutor', 'profile');
    }

    public function executeNew()
    {
    }

    public function executeProfile(){
    }

    /**
     * Action to show the page that says "The confirmation code has been sent to
     * your e-mail address."
     */
    public function executeConfirmationCodeSent()
    {
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
        $this->redirect('/dashboard');
    }
}
