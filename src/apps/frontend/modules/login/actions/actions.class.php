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

    public function preExecute()
	{
	//		$this->appcallbackurl = 'http://rayku';
	//		$this->appcanvasurl = 'http://apps.facebook.com/rayku';
	//		$appapikey = '0b60aa8352658ae667308f301eeda8ce';
	//		$appsecret = 'f6f39f025954444c01061415d2510bbf';

		//	$this->facebook = new Facebook($appapikey, $appsecret,true);
			//$this->user = $this->facebook->require_login();// id of Facebook user hat will add your app.Then, you can use $this->user in your all actions to get user id.

	}

	/**
	* Action to display login page
	*/
	public function executeIndex()
	{
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
			$sEmail = trim( $this->getRequestParameter('name') );
			$sPassword = trim( $this->getRequestParameter('pass') );


			if( $sEmail == '' && $sPassword == '' )
			{
			  $this->redirect( 'login/index' );
			}

				//Check the user credentials
			$this->user = UserPeer::checkLogin( $sEmail, $sPassword );

				if(!$this->user)
				{
					$_SESSION['loginErrorMsg']='Your username or password was incorrect.';
				}
				if($_SESSION['loginWrongPass']>=5)
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

				if (!$this->user) {
					$this->msg = 'Your username or password was incorrect.';
					/////incrementing session value plus one if the password is wrong
					$_SESSION['loginWrongPass']=$_SESSION['loginWrongPass']+1;

					if ($_SESSION['loginWrongPass']>=5) {
						$this->redirect("http://www.rayku.com/login");
					}
                    return sfView::ERROR;
				}

				//If the user hasn't confirmed their account, display a message
				if($this->user->isTypeUnconfirmed()) {
					$this->msg = 'You have not confirmed your account yet. Please go to your email inbox and click on the link in the confirmation email.';
					return sfView::ERROR;
				}

				//If user is teacher account expires after 6 month
				if ($this->user->getType() == UserPeer::getTypeFromValue('teacher')) {
					$currentdate = time();
					$prevdate = strtotime($this->user->getCreatedAt());

					$dateDiff = $currentdate - $prevdate ;

					$fullDays = floor($dateDiff/(60*60*24*30*6));

					if($fullDays == 1)
					{
						$this->msg = 'You need to upgrade your account to continue.';

						return sfView::ERROR;
					}
					//echo date_interval_create_from_date_string($this->user->getCreatedAt());
				}

				//If the user is banned, display a message
				if($this->user->getHidden()) {
					$this->msg = 'You are currently banned.';

					return sfView::ERROR;
				}

				if ($this->getRequestParameter('remember')) {
					$time = time() + 60 * 60 * 24 * 15;

					$this->getResponse()->setCookie("rEmail", $sEmail,$time);
					$this->getResponse()->setCookie("rPassword", $sPassword,$time);
				}

				$this->getUser()->signIn($this->user, $this->getRequestParameter('remember', false));
				$this->user->setInvisible($this->getRequestParameter('invisible', false));
                $_SESSION[$this->user->getUsername()] = time();

				$this->user->save();



		//$con = mysql_connect("127.0.0.1", "rayku", "rayku");
		//$db = mysql_select_db("rayku_db", $con);
        $connection = RaykuCommon::getDatabaseConnection();


		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		 $currentUser = $this->getUser()->getRaykuUser();

		$userId = $currentUser->getId();


		if(!empty($userId)) :

			mysql_query("delete from popup_close where user_id=".$userId, $connection) or die(mysql_error());
			mysql_query("delete from sendmessage where asker_id =".$userId, $connection) or die(mysql_error());
			mysql_query("delete from user_expert where checked_id=".$userId, $connection) or die(mysql_error());
		endif;


		if($_SESSION['modelPopupOpen']) :

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) :

				unset($_SESSION['popup_session']);
			endif;

		endif;


				if($this->getRequestParameter('referer') != 'http://www.rayku.com/login')
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

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);

		$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

		 $currentUser = $this->getUser()->getRaykuUser();

		if(!empty($logedUserId)) :

			mysql_query("delete from popup_close where user_id=".$logedUserId) or die(mysql_error());
			mysql_query("delete from sendmessage where asker_id =".$logedUserId) or die(mysql_error());
			mysql_query("delete from user_expert where checked_id=".$logedUserId) or die(mysql_error());
		endif;

		if($_SESSION['modelPopupOpen']) :

			unset($_SESSION['modelPopupOpen']);

			if($_SESSION['popup_session']) :

				unset($_SESSION['popup_session']);
			endif;

		endif;


		$this->getUser()->signOut();
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

	private function getRequestedUserType()
  	{
		$allowedTypes = array( UserPeer::getTypeFromValue( 'user' ),
							   UserPeer::getTypeFromValue( 'teacher' ),
							   UserPeer::getTypeFromValue( 'expert' ) );

		$requestedType = $this->getRequestParameter( 'utype' );

		if( in_array( $requestedType, $allowedTypes ) )
		  return $requestedType;
		else
		  return UserPeer::getTypeFromValue( 'user' );
  }


	public function executeNew()
	{


		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	        $db = mysql_select_db("rayku_db", $con);


		$queryName = mysql_query("select * from user where username='".$_POST['username']."' ") or die(mysql_error());

		$queryEmail = mysql_query("select * from user where email='".$_POST['email']."' ") or die(mysql_error());


		if(mysql_num_rows($queryName) > 0) {

			setcookie("username", 1, time()+100, "/", "rayku.com");
			$_COOKIE["username"] = 1;

						$_SESSION['username'] = $_POST['username'];
						$_SESSION['email'] = $_POST['email'];
						$_SESSION['password'] = $_POST['password'];
						$_SESSION['fullname'] = $_POST['fullname'];


				$this->redirect("http://www.rayku.com/start");


		} else {



					if(mysql_num_rows($queryEmail) > 0) {

							setcookie("username", 2, time()+100, "/", "rayku.com");
							$_COOKIE["username"] = 2;

						$_SESSION['username'] = $_POST['username'];
						$_SESSION['email'] = $_POST['email'];
						$_SESSION['password'] = $_POST['password'];
						$_SESSION['fullname'] = $_POST['fullname'];


								$this->redirect("http://www.rayku.com/start");


						} else {

						$_SESSION['username'] = $_POST['username'];
						$_SESSION['email'] = $_POST['email'];
						$_SESSION['password'] = $_POST['password'];
						$_SESSION['fullname'] = $_POST['fullname'];



							$this->redirect("http://www.rayku.com/login/facebooklogin");

						}


		}


	}


	public function executeFacebooklogin()
	{


		$this->requestedUserType = $this->getRequestedUserType();

		$user = new User();
		$user->setUsername($_SESSION['username']);
		$user->setEmail($_SESSION['email']);
		$user->setPassword($_SESSION['password']);
		$user->setName($_SESSION['fullname']);
		$user->setPoints('10');

    		$user->setTypeUnconfirmed( $this->requestedUserType );

		if(!$user->save())
			throw new PropelException('User creation failed');

//================================================================Modified By DAC021==============================================================================//


			$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

			$query = mysql_query("select * from user order by id DESC limit 0,1") or die(mysql_error());
			$row = mysql_fetch_array($query);

			$_SESSION['newUserTempID'] = $row['id'];


			setcookie("username", '', time()-100, "/", "rayku.com");
			$_COOKIE["username"] = '';


			unset($_SESSION['username']);
			unset($_SESSION['email']);
			unset($_SESSION['password']);
			unset($_SESSION['fullname']);

//================================================================Modified By DAC021==============================================================================//

	}


//======================================================================Modified By DAC021=====================================================================//

	public function executeShow()
	{


		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());
		$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

$count = count($_POST['course_subject']);

	for($i=0; $i < $count; $i++)
	{


		if(!empty($_POST['course_subject'][$i]))
				{

			mysql_query("insert into user_course(user_id,course_subject,course_name,course_year,course_performance) values('".$_SESSION['newUserTempID']."','".$_POST['course_subject'][$i]."','".$_POST['course_name'][$i]."','".$_POST['course_year']."','".$_POST['grade'][$i]."')") or die(mysql_error());

		$query = mysql_query("select * from expert_category where user_id=".$_SESSION['newUserTempID']) or die(mysql_error());
					$expertCategory = array();
					$j = 0;
					while($row = mysql_fetch_array($query))
						{
							$expertCategory[$j] = $row['category_id'];
							$j++;
						}
					if(!in_array($_POST['course_subject'][$i], $expertCategory)) {

						mysql_query("insert into expert_category(user_id,category_id) values('".$_SESSION['newUserTempID']."','".$_POST['course_subject'][$i]."')") or die(mysql_error());

						}
				}


	}

mysql_query("insert into user_score(user_id,score) values('".$_SESSION['newUserTempID']."','900')") or die(mysql_error());


	$a=new Criteria();
	$a->add(UserPeer::ID,$_SESSION['newUserTempID']);
	$newTempUser = UserPeer::doSelectOne($a);

  		$this->sendConfirmationEmail( $newTempUser );
		unset($_SESSION['newUserTempID']);

	}
//===================================================================Modified By DAC021=====================================================================//

	private function sendConfirmationEmail( User $user )
	  {
			$mail = Mailman::createMailer();
		$mail->setContentType('text/html');
			$mail->addAddress( $user->getEmail() );
			$mail->setSubject('Confirm your Rayku Account');
		sfProjectConfiguration::getActive()->loadHelpers(array('Asset','Url','Partial'));
			$mail->setBody(
		  get_partial(
			'activationEmailHtml',
			array( 'activationLink' => url_for( '@register_confirm?code='.$user->getConfirmationCode().'', true ),
				   'user' => $user ) ) );
		$mail->setAltBody(
		  get_partial(
			'activationEmail',
			array( 'activationLink' => url_for( '@register_confirm?code='.$user->getConfirmationCode().'', true ),
				   'user' => $user ) ) );
			$mail->send();
	  }


	public function executeTestfacebook()
	{
		//	$this->session_key = $this->fb->do_get_session();
		//	$this->uid = $this->fb->get_loggedin_user();

			$fbtoolbox= new FbToolbox('27361b7c544ba443e405884861b47a80','4d37539c26045eb625a61401ead28fea');
			$this->user=$fbtoolbox->getUserInfo($this->getRequestParameter('userdetails'));
			$this->username=strtolower($this->user[0]['first_name']."_".$this->user[0]['last_name']);

			$c=new Criteria();
			$c->add(UserPeer::EMAIL,$this->getUser()->getAttribute('facebookuseremail'));
			$euser=UserPeer::doSelectOne($c);

			$newnumber=0;
			$c=new Criteria();
			$c->add(UserPeer::USERNAME,$this->username);
			$newnumber=UserPeer::doCount($c);
			$newnumber=($newnumber>0)?'_'.$newnumber:'';
			if(!$euser)
			{
				$user = new User();
				$user->setUsername($this->username.$newnumber);
				$user->setEmail($this->getUser()->getAttribute('facebookuseremail'));
				$user->setPassword($this->getUser()->getAttribute('facebookpassword'));
				$user->setName($this->user[0]['first_name'] . ' ' . $this->user[0]['last_name']);
				$user->setGender($this->user[0]['sex']);
				$user->setBirthdate(date('y-m-d',strtotime($this->user[0]['birthday'])));
				$user->setType(UserPeer::getTypeFromValue('user'));
				$user->save();
			}
			//var_dump($this->user);

			$friends = $fbtoolbox->getFriendList($this->getRequestParameter('userdetails'));

			$this->friendsdetails = array();


			foreach($friends as $friend)
			{
				$this->tempuser=$fbtoolbox->getUserInfo($friend);
				$this->friendsdetails[$friend]=$this->tempuser[0]['first_name'] . ' ' . $this->tempuser[0]['last_name'];
			}


			$this->friends=$this->getRequestParameter('friend_list');




	//	var_dump($this->user);echo "hi";die;
		//echo "testfacebookhi";die;
	}

	public function executeEmailtofriends()
	{
		$selectedusers=$this->getRequestParameter('friends');

		$selected='';
		foreach($selectedusers as $value)
		{
					$selected=$selected . $value . ",";

		}

		$fbtoolbox= new FbToolbox('27361b7c544ba443e405884861b47a80','4d37539c26045eb625a61401ead28fea');

		//$fbtoolbox->sendEmail(substr($selected,0,strlen($selected)-1),'Please Visit Rayku','<fb:prompt-permission perms="email">Would you like to receive email from our application?</fb:prompt-permission>');
		$fbtoolbox->sendNotification(substr($selected,0,strlen($selected)-1),sfConfig::get('app_login_facebook_notification'),'app_to_user');
		$this->redirect('login/facebookfriends');
	}

	public function executeFacebookfriends()
	{

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

				    $this->redirect("http://www.rayku.com/dashboard");



	}

public function executeAnswer()
  {

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		                        $db = mysql_select_db("rayku_db", $con);

		if(!empty($_REQUEST['id'])) {

			$id =  $_REQUEST['id'];

			$time = time() - 600;

			$query = mysql_query("select * from user_expert where id=".$id." and time >= '".$time."' and status != 7 ") or die("Error1".mysql_error());

			if(mysql_num_rows($query) > 0) {



						$row = mysql_fetch_assoc($query);

						    $x = new Criteria();

						    $x->add(UserPeer::ID, $row['checked_id']);

					    	    $testUser = UserPeer::doSelectOne( $x );

						    $this->getUser()->signIn($testUser);


						$newId = $id + 1;

						$this->getResponse()->setCookie("askerid", $row['user_id'],time()+3600);

						$this->getResponse()->setCookie("expertid", $row['checked_id'],time()+3600);

						$asker = UserPeer::retrieveByPK($row['user_id']);

						$this->getResponse()->setCookie("check_nick", $asker->getName(), time()+3600);

						setcookie("asker_que",$row['question'], time()+600, "/");

						//$this->getResponse()->setCookie("asker_que", $row['question'],time()+600);

						$userdetail = mysql_query("select * from user where id=".$row['checked_id']." ") or die("Error2".mysql_error());

						if(mysql_num_rows($userdetail) > 0) {

							$rowuser = mysql_fetch_assoc($userdetail);

							$this->getResponse()->setCookie("loginname", $rowuser['name'],time()+3600);




						mysql_query("update user_expert set status = 7 where user_id =".$row['checked_id']) or die("Error5".mysql_error());

						mysql_query("delete from user_expire_msg where userid=".$row['checked_id']) or die("Error_Expire2".mysql_error());


						$this->redirect("http://www.rayku.com:8001/");

					    }






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


}
