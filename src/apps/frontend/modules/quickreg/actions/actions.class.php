<?php

/**
 * start actions.
 *
 * @package    elifes
 * @subpackage start
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class quickregActions extends sfActions
{
    public function preExecute() {
        RaykuCommon::getDatabaseConnection();
    }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
   	// $this->forward('default', 'module');   	
	
  }
  
  public function executeRegister()
  {
  	//If the user is logged in, don't let them register
	if ($this->getUser()->isAuthenticated())
	{
	$this->error = 'You are already logged in. You can not register again.';
	return sfView::ERROR;
	}
	$this->requestedUserType = '1';
	//Create and populate the User object
	$user = new User();
	
	$userName = str_replace(' ','',strtolower($this->getRequestParameter('name')));
	$user->setName($this->getRequestParameter('name'));
	$user->setEmail($this->getRequestParameter('email'));
	$user->setPassword($this->getRequestParameter('password'));
	
	
	$_SESSION['question'] = $this->getRequestParameter('question');
	
	//$user->setPoints('10.11');
	$user->setTypeUnconfirmed($this->requestedUserType);
	
	/* Username Duplication Check */
	$unamequery = mysql_query("select * from user where username='".$userName."'");
	$unamecount = mysql_num_rows($unamequery);
	
	$dupval = 2;
	duplicationCheck:
	if($unamecount>=1)
	{
		$newUsername = $userName.$dupval;
		$unamequery = mysql_query("select * from user where username='".$newUsername."'");
		$unamecount = mysql_num_rows($unamequery);
		if($unamecount>=1)
		{
			$dupval++;
			goto duplicationCheck;
		}
		else
		{
			$userName = $newUsername;
		}
	}
	$user->setUsername($userName);
	
	//Try to save the User... throw an exception if something messes up		
	if(!$user->save())
	throw new PropelException('User creation failed');

	mysql_query("insert into expert_category(user_id,category_id) values('".$user->getId()."','1')") or die(mysql_error());

	mysql_query("insert into user_score(user_id,score) values('".$user->getId()."','1')") or die(mysql_error());

	$this->sendConfirmationEmail( $user );

	$this->forward('quickreg', 'confirmationcode');
	
	//$this->redirect("http://www.rayku.com/quickreg/confirmationcodesent");
  }
  	private function sendConfirmationEmail( User $user )
	{
		$mail = Mailman::createMailer();
		$mail->setContentType('text/html');
		$mail->addAddress( $user->getEmail() );
		$mail->setSubject('Activate your new account');
		sfProjectConfiguration::getActive()->loadHelpers(array('Asset','Url','Partial'));
		$mail->setBody(
		get_partial(
		'activationEmail',
		array( 'confirmationCode' => $user->getConfirmationCode(),
	       'user' => $user ) ) );
		$mail->setAltBody(
		get_partial(
		'activationEmailHtml',
		array( 'confirmationCode' => url_for( '@register_confirm?code='.$user->getConfirmationCode(), true ),
	       'user' => $user ) ) );
		
		$mail->send();
	}
	
	public function executeConfirmationcode()
	{
		
	}
	
	public function executeConfirmpopup()
	{
	}
	
	public function executeConfirmuser()
	{
		
		//Load the user from activation code
		$user = UserPeer::doSelectFromConfirmationCode( $_REQUEST['confirmationcode'] );
		//If the user doesn't exist, display an error
		if(!$user) {
		

		$oC = new Criteria();
		$oC->add( UserPeer::ID, "SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$newCode'" , Criteria::CUSTOM );
		$oC->add( UserPeer::TYPE, '1' );

		$userCheck = UserPeer::doSelectOne( $oC );

		if(!$userCheck) {
				
				$_SESSION['confirm_user_error'] = "Invalid Confirmation Code.";
				
				$this->redirect("http://www.rayku.com/quickreg/confirmationcode");
				//return sfView::ERROR;
		}



		}
		//print_r($_POST);exit;
		$newCode = $_REQUEST['confirmationcode'];
		$courseId = $_REQUEST['course_id'];
		$education = $_REQUEST['edu'];
		$university = $_REQUEST['name'];
		$courseCode = $_REQUEST['course_code'];
		$year = $_REQUEST['asker_year'];
		$grade =$_REQUEST['asker_grade'];
		$dashHidden =$_REQUEST['dash_hidden'];
		
		$_SESSION['course_id'] = $courseId;
		$_SESSION['edu'] = $education;
		$_SESSION['name'] = $university;
		$_SESSION['course_code'] = $courseCode;
		$_SESSION['dash_hidden'] = $dashHidden;
		
		if($year!='Choose year')
		{
			$_SESSION['year'] = $year;
		}
		
		if($grade!='Choose grade')
		{
			$_SESSION['grade'] = $grade;
		}


		if($user) {
			$user->setTypeConfirmed();
			$user->save();
		} 

		if($user) {
		$this->getUser()->signIn($user);

		} else {
		$this->getUser()->signIn($userCheck);
		}

		if($user) {
			$kinkarsoUser = FriendPeer::createInitialFriendship($user);
		} 
		
		if( $kinkarsoUser ) {

		if($user) {
		$query = mysql_query("select * from  shout where recipient_id=".$user->getId()." and  poster_id=".$kinkarsoUser->getId()."") or die(mysql_error());
			if(mysql_num_rows($query) == 0) {


				 ShoutPeer::createWelcomeComment($user,$kinkarsoUser);

		  	 	 JournalEntryPeer::createHelloWorldEntryFor($user);

			}

		} 



		 $subject='Welcome to Rayku';

			if($user) {
					 $body='Hey '.$user->getName().', welcome to Rayku.com!<br><br>';

			} 

		 
		 $body .=' Thanks for joining our community!<br><br>
		 
		 The first thing you should do is introduce yourself. We\'re interested in hearing your story, if you are a potential tutor or tutee.<br><br>
		 
		 Let us know by creating a thread in the <a href="http://www.rayku.com/forum/newthread/125">Introductions Forum</a>.<br><br>
		 				 
		 Thanks!<br>
		 Rayku Administration';
		 
		 
		$currentuser = $kinkarsoUser;
		//Send the message

		if($user) {
			$currentuser->sendMessage($user->getId(),$subject,$body);
		} 


		$gallery = new Gallery();
		$gallery->setTitle('Profile Pictures');
		$gallery->setShowEntity(0);
		$gallery->save();


		}



			$this->redirect("http://www.rayku.com/expertmanager/list");
	}
	
	public function executeDuplicationcheck()
	{
		$emailId = $_REQUEST['emailId'];
		
		
		$_query = mysql_query("select * from user where email='".$emailId."'") or die(mysql_error());

		if(mysql_num_rows($_query) > 0) :

			echo "yes";			

		else :

			echo "no";	

		endif;
		exit(0);
	}
	
}
