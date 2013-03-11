<?php

/**
 * login actions.
 *
 * @package    elifes
 * @subpackage login
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */


class loginActions extends sfActions
{
	public $fb,$user,$session_key,$uid;

	/**
	 * Action to display login page
	 */
	public function executeIndex()
	{
		if($this->getRequest()->isMethod('POST')){
			$this->executeLoginCheck();
		}
		//If the user is logged in, don't let them login again

		if($this->getUser()->isAuthenticated())
			return sfView::ERROR;


		$referer_rel = $_SERVER["REQUEST_URI"];
		$referer_abs = "http://" . $_SERVER["HTTP_HOST"] . $referer_rel;

		$this->getRequest()->getAttributeHolder()->set('referer', $referer_abs);

	}

	/**
	 * Action to check login credentials
	 */
	public function executeLoginCheck()
	{
		$connection = RaykuCommon::getDatabaseConnection();

		$sEmail = trim( $this->getRequestParameter('name') );
		$sPassword = trim( $this->getRequestParameter('pass') );
		
		$user_new_login = $this->getRequestParameter('user');
		if(!empty($user_new_login)){
			$sEmail = $user_new_login['login_email'];
			$sPassword = $user_new_login['login_password'];
		}
		
		if( $sEmail == '' && $sPassword == '' )
		{
			StatsD::increment("login.failure");
			$this->redirect( 'login/index' );
		}

		//Check the user credentials
		$this->user = UserPeer::checkLogin( $sEmail, $sPassword );

		if(!$this->user)
		{
			StatsD::increment("login.failure");
			$_SESSION['loginErrorMsg']='Your username or password was incorrect.';
		} else {
			$id=$this->user->getId();
			$tutor=mysql_num_rows(mysql_query("SELECT * FROM tutor_profile WHERE user_id='$id'"));
			if($tutor==1){
				StatsD::increment("login.tutor.success");
			}else{
				StatsD::increment("login.student.success");
			}
		}

		/**
		 * @todo - check if we ever got a chance to hit this place with recaptch - it looks like no so either lets remove it or make it working
		 */
		if(isset($_SESSION['loginWrongPass']) && $_SESSION['loginWrongPass']>=5)
		{

			require_once($_SERVER['DOCUMENT_ROOT'].'/recaptcha/recaptchalib.php');

			// Get a key from https://www.google.com/recaptcha/admin/create
			$publickey = "6Lc_mscSAAAAAE0Bxon37XRl56V_l3Ba0sqib2Zm";
			$privatekey = "6Lc_mscSAAAAAKG3YnU2l3uHYqcBDB6R31XlVTW8";

			# the response from reCAPTCHA
			$resp = null;
			# the error code from reCAPTCHA, if any
			$error = null;

			# was there a reCAPTCHA response?

			$resp = recaptcha_check_answer ($privatekey,
			$_SERVER["REMOTE_ADDR"],
			$_POST["recaptcha_challenge_field"],
			$_POST["recaptcha_response_field"]);




			if ($resp->is_valid) {
				$_SESSION['loginWrongPass']=0;
				$_SESSION['recaptchaError']='';

			} else {
				# set the error code so that we can display it
				$_SESSION['recaptchaError'] = $resp->error;

				$this->user=false;
			}

		}

		if(!$this->user)
		{
			$this->msg = 'Your username or password was incorrect.';
			/////incrementing session value plus one if the password is wrong
			$_SESSION['loginWrongPass']=@$_SESSION['loginWrongPass']+1;



			if($_SESSION['loginWrongPass']>=5)
			{
				$this->redirect("/login");

			}
			return sfView::ERROR;
		}

		//If the user hasn't confirmed their account, display a message
		if($this->user->isTypeUnconfirmed())
		{
			$this->msg = 'You have not confirmed your account yet. Please go to your email inbox and click on the link in the confirmation email.';
			return sfView::ERROR;
		}

		//If the user is banned, display a message
		if($this->user->getHidden())
		{
			$this->msg = 'You are currently banned.';

			return sfView::ERROR;
		}

		$this->getUser()->signIn($this->user, $this->getRequestParameter('remember', false));

		/**
		 * Invisible in practice means "invisible until next login"
		 * On each login this flag is set either to 0 or 1
		 * There is no possibility to change invisible status while being logged in
		*/
		$this->user->setInvisible($this->getRequestParameter('invisible', false));



		$_SESSION[$this->user->getUsername()] = time();


		$this->user->save();


		$currentUser = $this->getUser()->getRaykuUser();

		$userId = $currentUser->getId();


		if(!empty($userId)) {

			mysql_query("delete from popup_close where user_id=".$userId, $connection) or die(mysql_error());
			mysql_query("delete from sendmessage where asker_id =".$userId, $connection) or die(mysql_error());
			mysql_query("delete from user_expert where checked_id=".$userId, $connection) or die(mysql_error());
		}


		if(isset($_SESSION['modelPopupOpen'])) {

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) {

				unset($_SESSION['popup_session']);
			}
		}

		if($this->getRequestParameter('referer') != 'http://'.RaykuCommon::getCurrentHttpDomain().'/login')
		{
			if($this->getRequestParameter('referer') != NULL)
			{

				return $this->redirect($this->getRequestParameter('referer'));
			}
		}
		else
		{
			return sfView::SUCCESS;
		}

	}


	public function executeLogout()
	{
		$this->getResponse()->setCookie("loginname", "",time() - 3600, '/', sfConfig::get('app_cookies_domain'));

		$connection = RaykuCommon::getDatabaseConnection();

		$logedUserId = @$_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
		if (!$logedUserId) {
			$this->redirect('/');
		}

		$currentUser = $this->getUser()->getRaykuUser(); $userId = $currentUser->getId();

		if(!empty($userId)) {

			mysql_query("delete from popup_close where user_id=".$userId, $connection) or die(mysql_error());
			mysql_query("delete from sendmessage where asker_id =".$userId, $connection) or die(mysql_error());
			mysql_query("delete from user_expert where checked_id=".$userId, $connection) or die(mysql_error());
		}

		if(isset($_SESSION['modelPopupOpen'])) {

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) {

				unset($_SESSION['popup_session']);
			}
		}

		$this->getUser()->signOut();


		if ($this->getRequestParameter('redirectTo')) {
			$redirectTo = $this->getRequestParameter('redirectTo');
			switch ($redirectTo) {
				case 'idle': $this->redirect('login/idleLogout');
			}
		}

		$this->redirect('@homepage');
	}

	public function executeRecoverPassword()
	{
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{

			$email = $this->getRequestParameter('email');

			// send confirmation email
			$user = UserPeer::getByEmail($email);

			$user->generatePasswordRecoverKey();

			$this->getRequest()->setAttribute('user', $user);

			sfProjectConfiguration::getActive()->loadHelpers(array('Asset','Url','Partial'));

			$user = $this->getRequest()->getAttribute('user');
			/* @var $user User */

			$this->mail = Mailman::createMailer();

			// set from, to and subject
			$this->mail->addAddress($user->getEmail());
			$this->mail->setSubject('Rayku.com Password Reset Request');

			// set view vars
			$this->name = $user->getName();
			$this->key = $user->getPasswordRecoverKey();
			$this->mail->setBody(get_partial('passwordReminderConfirmation',  array( 'name' => $this->name, 'key' => $this->key ) ) );
			$this->mail->send();


			// $this->getController()->sendEmail('login', 'sendPasswordReminderConfirmation');

			$this->redirect('@recover_password_sent');
		}
	}

	public function handleErrorRecoverPassword()
	{
		return sfView::SUCCESS;
	}

	public function executeRecoverPasswordSent()
	{
	}

	public function executeResetPassword()
	{
		$user = UserPeer::getByPasswordRecoveryKey($this->getRequestParameter('key'));

		$this->forward404Unless($user instanceof User);

		$password = $user->generateNewPassword();
		$user->setPasswordRecoverKey(NULL);
		$user->save();

		$this->getRequest()->setAttribute('user', $user);
		$this->getRequest()->setAttribute('password', $password);

		sfProjectConfiguration::getActive()->loadHelpers(array('Asset','Url','Partial'));

		$password = $this->getRequest()->getAttribute('password');
		$user = $this->getRequest()->getAttribute('user');
		/* @var $user User */

		$this->mail = Mailman::createMailer();

		// set from, to and subject
		$this->mail->addAddress($user->getEmail());
		$this->mail->setSubject('Your New Rayku.com Password');

		// set view vars
		$this->name = $user->getName();

		$this->mail->setBody(get_partial('sendNewPassword',  array( 'name' => $this->name, 'password' => $password ) ) );
		$this->mail->send();


		// $this->getController()->sendEmail('login', 'sendNewPassword');
	}

	public function executeSendPasswordReminderConfirmation()
	{


		$user = $this->getRequest()->getAttribute('user');
		/* @var $user User */

		$this->mail = Mailman::createMailer();

		// set from, to and subject
		$this->mail->addAddress($user->getEmail());
		$this->mail->setSubject('Rayku.com Password Reset Request');

		// set view vars
		$this->name = $user->getName();
		$this->key = $user->getPasswordRecoverKey();

		return sfView::SUCCESS;

	}

	public function executeSendNewPassword()
	{
		$password = $this->getRequest()->getAttribute('password');
		$user = $this->getRequest()->getAttribute('user');
		/* @var $user User */

		$this->mail = Mailman::createMailer();

		// set from, to and subject
		$this->mail->addAddress($user->getEmail());
		$this->mail->setSubject('Rayku.com New Password');

		// set view vars
		$this->name = $user->getName();
		$this->password = $password;

	}

	public function executeSecure()
	{

	}

	public function executeValidateEmail()
	{


		$email = $this->getRequestParameter('email');

		if($email != NULL)
		{

			$c= new Criteria();
			$c->add(UserPeer::EMAIL,$this->getRequestParameter('email'));
			$useremail = UserPeer::doSelectOne($c);

			if($useremail != NULL)
			{
				echo '1';
			}

		}

	}


	public function executeTestaccount() {


		$x = new Criteria();

		$x->add( UserPeer::ID, 1437);

		$testUser = UserPeer::doSelectOne( $x );

		$this->getUser()->signIn($testUser);

		$this->redirect("/dashboard");



	}

	public function executeAnswer()
	{
		$connection = RaykuCommon::getDatabaseConnection();

		if (empty($_REQUEST['id'])) {
			return;
		}

		$id =  $_REQUEST['id'];
		$time = time() - 600;

		$query = mysql_query("select * from user_expert where id=".$id." and time >= '".$time."' and status != 7 ", $connection) or die("Error1".mysql_error());

		if (mysql_num_rows($query) > 0) {
			$row = mysql_fetch_assoc($query);
			$x = new Criteria();
			$x->add(UserPeer::ID, $row['checked_id']);

			$testUser = UserPeer::doSelectOne( $x );

			$this->getUser()->signIn($testUser);
			$asker = UserPeer::retrieveByPK($row['user_id']);
			$askerUsername = $asker->getUsername();
			$askerName = $asker->getName();

			$this->getResponse()->setCookie("check_nick", urlencode($askerName), time()+3600, '/', sfConfig::get('app_cookies_domain'));
			$this->getResponse()->setCookie("askerUsername", $askerUsername, time()+3600, '/', sfConfig::get('app_cookies_domain'));
			$this->getResponse()->setCookie("askerid", $row['user_id'],time()+3600, '/', sfConfig::get('app_cookies_domain'));
			$this->getResponse()->setCookie("expertid", $row['checked_id'],time()+3600, '/', sfConfig::get('app_cookies_domain'));
			$this->getResponse()->setCookie("asker_que", urlencode($row['question']), time()+600, "/", sfConfig::get('app_cookies_domain'));

			$userdetail = mysql_query("select * from user where id=".$row['checked_id']." ", $connection) or die("Error2".mysql_error());
			if(mysql_num_rows($userdetail) > 0) {
				$rowuser = mysql_fetch_assoc($userdetail);
				$name =  str_replace(" ","", $rowuser['name']);
				$this->getResponse()->setCookie("loginname", $name, time()+3600, '/', sfConfig::get('app_cookies_domain'));
				mysql_query("update user_expert set status = 7 where user_id =".$row['checked_id'], $connection) or die("Error5".mysql_error());
				mysql_query("delete from user_expire_msg where userid=".$row['checked_id'], $connection) or die("Error_Expire2".mysql_error());

				$this->redirect("/");
			}
		}
	}

	public function executeValidateUsername()
	{

		$name = $this->getRequestParameter('username');

		if($name != NULL)
		{

			$c= new Criteria();
			$c->add(UserPeer::USERNAME,$name);
			$username = UserPeer::doSelectOne($c);

			if($username != NULL)
			{
				echo '2';
			}
		}
	}


	public function executeIdleLogout()
	{

	}
}
