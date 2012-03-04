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
	
	/**
	* Action to show the registration form
	*/
	public function executeIndex()
	{


		//If the user is logged in, don't let them register
		if ($this->getUser()->isAuthenticated())
		{
      $this->error = 'You are already logged in. You can not register again.';
			return sfView::ERROR;
		}
    
    $this->requestedUserType = $this->getRequestedUserType();
		
		//If the form hasn't yet been filled in, just display the form
		if( sfWebRequest::POST !== $this->getRequest()->getMethod() )
		{

			return sfView::SUCCESS;
		}

    if( $this->getRequestParameter( 'terms' ) != 1 )
    {
      $this->error = 'You must agree to our <strong>Terms & Conditions</strong>. <a href="#" onClick="javascript: history.go(-1)">Click here</a> to go back to the previous page.';
      return sfView::ERROR;
    }

		if( $this->requestedUserType == UserPeer::getTypeFromValue('teacher') )
		{
      if( !$this->checkInvitationCode( $this->getRequestParameter('confirmationcode') ) )
      {
        $this->error = 'Please enter a valid confirmation code!';
        return sfView::ERROR;
      }
		}
		$connection = RaykuCommon::getDatabaseConnection();

		//Create and populate the User object
		$user = new User();
		$user->setUsername($this->getRequestParameter('username'));
		$user->setEmail($this->getRequestParameter('email'));
		$user->setPassword($this->getRequestParameter('password1'));

		$user->setName($this->getRequestParameter('username'));

		//$user->setPoints('10.11');
		
		// GENERATE USERNAME FROM FULL NAME FIELD
		
		$userName = str_replace(' ','',strtolower($this->getRequestParameter('username')));
		
		$U_QRY = "select * from user where username='".$userName."'";
		
		$u_res = mysql_query($U_QRY, $connection);
		
		$unamecount = mysql_num_rows($u_res);
		 
		$dupval = 2;
        duplicationCheck:
        if($unamecount>=1)
        {
                $newUsername = $userName.$dupval;
                $unamequery = mysql_query("select * from user where username='".$newUsername."'", $connection);
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
		
		
		// END of GENERATE USERNAME FROM FULL NAME FIELD
		

    	$user->setTypeUnconfirmed( $this->requestedUserType );



		if(!empty($_POST['coupon'])) :

                        $connection = RaykuCommon::getDatabaseConnection();


			$query = mysql_query("select * from referral_code where referral_code='".$_POST['coupon']."'", $connection) or die(mysql_error());

			if(mysql_num_rows($query) > 0)
			{

				$rowValues = mysql_fetch_assoc($query);	//$rowValues['user_id']; 

				$query = mysql_query("select * from user where id=".$rowValues['user_id'], $connection) or die(mysql_error());	
				$rowDetails = mysql_fetch_assoc($query);	

				 $newPoints = $rowDetails['points'] + 0.5;

				mysql_query("update user set points='".$newPoints."' where id=".$rowValues['user_id'], $connection) or die(mysql_error());

				mysql_query("delete from referral_code where referral_code='".$_POST['coupon']."'", $connection) or die(mysql_error());

			} else {
				
			
				if($_POST['coupon'] == 'launch11') {

					$points = "10";

				} elseif($_POST['coupon'] == 'promo92') {

					$points = "12";

				} elseif($_POST['coupon'] == 'uoft9211' ) {

					$points = "8";
				}

			}

		endif; 

		//Try to save the User... throw an exception if something messes up		
		if(!$user->save())
			throw new PropelException('User creation failed');

		if( $this->requestedUserType == UserPeer::getTypeFromValue('expert') )
   		 {
			$this->notify=$this->getRequestParameter('notify_email').','.$this->getRequestParameter('notify_sms');
			$user->setNotification($this->notify);
			$user->setPhoneNumber($this->getRequestParameter('phone_number'));

      $this->subscribeExpertToCategories($this->getRequestParameter('categories'), $user);
		}


	
		if(!empty($_POST['coupon']) && !empty($points)) {

				mysql_query("update user set points='".$points."' where id=".$user->getId(), $connection) or die(mysql_error());

		} elseif(!empty($_POST['coupon'])) {

			mysql_query("update user set points='11' where id=".$user->getId(), $connection) or die(mysql_error());


		}


mysql_query("insert into expert_category(user_id,category_id) values('".$user->getId()."','1')", $connection) or die(mysql_error());

mysql_query("insert into user_score(user_id,score) values('".$user->getId()."','1')", $connection) or die(mysql_error());

    $this->sendConfirmationEmail( $user );

		$this->forward('register', 'confirmationCodeSent');
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

  private function subscribeExpertToCategories( $categories, User $user )
  {
    if( !is_array( $categories ) )
      return;

    foreach($categories as $categoryid)
    {
      $category = CategoryPeer::retrieveByPK($categoryid);
      if( !$category )
        continue;

      $expertcat = new ExpertCategory();
      $expertcat->setUser( $user );
      $expertcat->setCategory( $category );
      $expertcat->save();

    }
  }

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
        array( 'activationLink' => url_for( '@register_confirm?code='.$user->getConfirmationCode(), true ),
               'user' => $user ) ) );
    $mail->setAltBody(
      get_partial(
        'activationEmail',
        array( 'activationLink' => url_for( '@register_confirm?code='.$user->getConfirmationCode(), true ),
               'user' => $user ) ) );
		$mail->send();
  }

  private function checkInvitationCode( $invitationCode )
  {
    if( $invitationCode != '' )
    {
      $user = UserPeer::doSelectFromInvitationHash( $invitationCode );
      return is_object( $user );
    }

    return false;
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


		//Load the user from activation code
		$user = UserPeer::doSelectFromConfirmationCode( $this->getRequestParameter('code') );

		//If the user doesn't exist, display an error
		if(!$user) {

			$newCode = $this->getRequestParameter('code');

			    $oC = new Criteria();
			    $oC->add( UserPeer::ID, "SHA1( CONCAT( user.password, 'salt', user.id ) ) = '$newCode'" , Criteria::CUSTOM );
			    $oC->add( UserPeer::TYPE, '1' );



		    	    $userCheck = UserPeer::doSelectOne( $oC );

				if(!$userCheck) {

						return sfView::ERROR;
				}



		}

		if($user) {

			    $user->setTypeConfirmed();
			    $user->save();

		} 




   // sfProjectConfiguration::getActive()->loadHelpers(array('Partial'));

   /* $this->mail = Mailman::createMailer();
    $this->mail->setContentType('text/html');
    $this->mail->addAddress( $user->getEmail() );
    $this->mail->setSubject('Welcome to Rayku.com!');
		$this->mail->setBody(
      get_partial(
        'confirmationEmailHtml',
        array( 'user' => $user ) ) );
    $this->mail->setAltBody(
      get_partial(
        'confirmationEmail',
        array( 'user' => $user ) ) );
//================================================================Modified By DAC021==============================================================================//
   $this->mail->send();*/
//================================================================Modified By DAC021==============================================================================//


	if($user) {

	    			$this->getUser()->signIn($user);

		} else {

				$this->getUser()->signIn($userCheck);
		}

	if($user) {

 	   $kinkarsoUser = FriendPeer::createInitialFriendship($user);


	} 
                $connection = RaykuCommon::getDatabaseConnection();
   
    if( $kinkarsoUser ) {

					if($user) {

					$query = mysql_query("select * from  shout where recipient_id=".$user->getId()." and  poster_id=".$kinkarsoUser->getId()."", $connection) or die(mysql_error());
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

		
		if($user) {

			$this->forward('register', 'new');

		} else {

			$this->redirect("http://www.rayku.com/dashboard/getstarted");
		}
		
		

		//$this->redirect("http://www.rayku.com/regtutor");
	
	}

	

	public function executeNew()
	{

		//$this->redirect('@register_step3?userid=' . $user->getId());

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
	* Action to show the registration step 3 form
	*/
	public function executeStepthird()
	{
		
		$user = $this->getUser()->getRaykuUser();
		
		// if form is submitted, persist the data
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			$user->setGender($this->getRequestParameter('user[gender]'));
			$user->setHometown($this->getRequestParameter('hometown'));
			$user->setHomePhone($this->getRequestParameter('home_phone'));
			$user->setMobilePhone($this->getRequestParameter('mobile_phone'));
			$user->setAddress($this->getRequestParameter('address'));
			$user->setRelationshipStatus($this->getRequestParameter('user[relationshipstatuse]'));
			$user->setAboutMe($this->getRequestParameter('about_me'));
			$user->setUserInterestsFromString($this->getRequestParameter('hobbies'));
			
			$user->save();
			if($this->getRequest()->getFileName('file')!="")
			{
				$mimeType = $this->getRequest()->getFileType('file');
				$validMimeTypes = sfConfig::get('app_gallery_valid_mime_types');
				//add new album
				$c= new Criteria();
				$c->add(AlbumPeer::OWNER_ID,$user->getId());
				$album=AlbumPeer::doSelectOne($c);
				if(!$album)
				{
					$album=new Album();
					$album->setName("Profile");
					$album->setDescription("Profile Picture Album");
					$album->setOwnerId($user->getId());
					$album->save();
				}
				//add profile picture into album
				$c= new Criteria();
				$c->add(PicturePeer::OWNER_ID,$user->getId());
				$c->add(PicturePeer::ALBUM_ID,$album->getId());
				$pic=PicturePeer::doSelectOne($c);
				if(!$pic)
				{
					$pic=new Picture();
					$pic->setDescription("Profile Pictures");
					$pic->setAlbum($album);
          $pic->setUser( $user );
				}
				$pic->setName($this->getRequest()->getFileName('file'));
				$pic->save();
				
				
				$c = new Criteria();
				$c->add(GalleryPeer::TITLE,'Profile Pictures');
				$c->add(GalleryPeer::USER_ID,$user->getId());
				$gallery = GalleryPeer::doSelectOne($c);
				
				$galleryItem = new GalleryItem();
				$galleryItem->setGallery($gallery);
				$galleryItem->setFileName($this->getRequest()->getFileName('file'));
				$galleryItem->setMimeType($mimeType);
				$galleryItem->setIsImage(in_array($mimeType, $validMimeTypes['image']));
				$galleryItem->save();
				
				
        		$user->setPicture( $pic );
				$user->save();
				
				// move to uploads
				$uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_gallery_upload_folder');
				
				$uploadDirAvatar = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . sfConfig::get('app_general_avatar_folder');
				
				if (!file_exists($uploadDir))
				{
					mkdir($uploadDir, 0700, true);
				}
				if (!file_exists($uploadDirAvatar))
				{
					mkdir($uploadDirAvatar, 0700, true);
				}
				
				// $filename = $pic->getId();
				
				
				$filename = $galleryItem->getId();
				$avafilename = $user->getId();
				$target = $uploadDir . DIRECTORY_SEPARATOR . $filename;
				$targetava = $uploadDirAvatar . DIRECTORY_SEPARATOR . $avafilename;
				
				$successfullyMoved = $this->getRequest()->moveFile('file', $target.".jpg");
				
				if (!$successfullyMoved)
				{
					throw new Exception('Could not move uploaded file');
				}

				// set filename to the id
				
				$galleryItem->setFileSystemPath($galleryItem->getId());
				$galleryItem->save();
											
				if(in_array($mimeType, $validMimeTypes['image']))
				{
					// resize image
					$thumb = new sfThumbnail(sfConfig::get('app_gallery_image_max_width'), sfConfig::get('app_gallery_image_max_height'));
					$thumb->loadFile($target.".jpg");
					$thumb->save($target);

          			RaykuCommon::writeAvatarImage($target.".jpg", $user->getId());
					
					// create thumb
					$thumb = new sfThumbnail(sfConfig::get('app_gallery_thumbnail_max_width'), sfConfig::get('app_gallery_thumbnail_max_height'));
					$thumb->loadFile($target.".jpg");
					$thumb->save($target . 'thumb'); 
					
					// create thumb
					$thumb = new sfThumbnail(sfConfig::get('app_gallery_thumbnail2_max_width'), sfConfig::get('app_gallery_thumbnail2_max_height'));
					$thumb->loadFile($target);
					$thumb->save($target . 'thumb2');
					
					
					
				}
			}
				
			//go to step forth of registration
			$this->redirect('@register_step4');
		}
		
		// passing to view
		$this->user = $user;
	}
	
	/**
	* Action to show the registration step 4 form
	*/
	public function executeStepforth()
	{
		 
		//  require_once('/home/rayku/lib/OpenInviter/openinviter.php');
		
		 $user = $this->getUser()->getRaykuUser();
	   // passing to view
		 $this->user = $user;		
		/* getting all email providers array */	

	//	$inviter=new OpenInviter();
	//	$oi_services=$inviter->getPlugins();
	//	$this->email = array();
	//	foreach ($oi_services as $type=>$providers)	
	//		{									
	//			foreach ($providers as $provider=>$details)
	//				$this->email[$provider] = $details['name'];
						
				/* exit when socail networking starts */
	//			break;		
	//		}
		
		
		
	}
	
	/**
	* Action to show the registration step 4 form
	*/
	public function executeGetcontact()
	{		
	
$loginuser = $this->getUser()->getRaykuUser();


		//	require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'OpenInviter'.DIRECTORY_SEPARATOR.'openinviter.php');		
	
			require_once('/home/rayku/lib/OpenInviter/openinviter.php');
		
		$user = UserPeer::retrieveByPk($loginuser->getId());
	    $display_array=array();
		if (sfWebRequest::POST === $this->getRequest()->getMethod())
		{
			$username = $this->getRequestParameter('username');
			$password = $this->getRequestParameter('password');			
				
			if($password == '')				
				return false;

			$inviter=new OpenInviter();			
			
			if(!$inviter->startPlugin($this->getRequestParameter('webmailProvider'),$inviter->getPlugins()))
				{
					var_dump($inviter->getInternalError());
					return false;
				}	
			elseif(!$inviter->login($username,$password))
				{				
					var_dump($inviter->getInternalError());
					return false;
				}
			else
				{
					$this->display_array=$inviter->getMyContacts();
					$this->user = $user;
				}	
		}
		
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
		
		if($user)
		{
			foreach($list as $name_email)
			{
				$user->sendPointsFromAdmin(sfConfig::get('app_general_invite_points'));
				list($to,$name) = @split('x22z',$name_email);
			
			if (ereg('@',$name)){
				$name = "";
				}
				
				if($to)
				{

				$refcode = $user->getUsername()."-".crypt($user->getUsername().$j,md5($user->getUsername().$j.time()));

                                $connection = RaykuCommon::getDatabaseConnection();

				mysql_query("insert into referral_code(user_id, referral_code, date) values(".$user->getId().", '".$refcode."', '".$date."') ", $connection) or die(mysql_error());

          sfProjectConfiguration::getActive()->loadHelpers( array( 'Partial' ) );

					$this->mail->setBody( "<p>".$user->getName()." has given you coupon credit through Rayku.com.</p><p>Value of Coupon: <strong>5.5 Rayku Points</strong> ($5.50 Canadian Dollars)<br />Eligibility: <strong>University of Toronto Students</strong><br />Expiration Date: <strong>xx/xx/2011</strong><br />Unique Coupon Code: <b>".$refcode."</b></p>". get_partial( 'invitationEmailHtml', array( 'name' => $name, 'user' => $user ) ));
					
					$this->mail->setContentType('text/html');
					$this->mail->addAddress($to);
					$this->mail->send();
					
				$j++;
					
				}


			}
		}

			
		//redirect
			$this->redirect('@register_step4');
		
	}





	public function executeInvitation()
	{


		$user = $this->getUser()->getRaykuUser();

		$this->user = $user;
		
		$username = $user->getUsername();



		$date = date("Y-m-d");

		if(!empty($_POST)) :

		for($i=0; $i < 5; $i++) {

			if($user<>''){

				$refcode=$user->getUsername()."-".crypt($username.$i,md5($username.$i.time()));

                                $connection = RaykuCommon::getDatabaseConnection();

				mysql_query("insert into referral_code(user_id, referral_code, date) values(".$user->getId().", '".$refcode."', '".$date."') ", $connection) or die(mysql_error());
			
			}
		}

		$this->flag = 1;

		endif;
		
	}

	
	/**
	 * show the latest user header
	 */
	public function executeLatestUserHeader()
	{
		sfProjectConfiguration::getActive()->loadHelpers('Partial');

		$user = $this->getUser()->getRaykuUser();
		
			if($user->getPoints() < 2) {

                                        $connection = RaykuCommon::getDatabaseConnection();

					$query = mysql_query("select * from points_notify where userid=".$user->getId(), $connection) or die(mysql_error());

					if(mysql_num_rows($query) == 0) {

						$this->mail = Mailman::createCleanMailer();
						$this->mail->setSubject('Rayku Points - Almost used up!');
						$this->mail->setFrom('Bonnie Pang <bonniecs@rayku.com>');
						$to = $user->getEmail(); 
					
						$this->mail->setBody( "<p>Hi there,<br /><br />I've noticed that your Rayku \$RP balance has just fallen below 2$RP. I really hope you've spent them well!<br /><br />In order to get more Rayku Points, here's two quick & instant options: <br /><a href='http://www.rayku.com/shop/paypal'><strong>Buy Rayku Points</strong></a><br /><a href='http://www.rayku.com/register/invitation'><strong>Invite Your Friends (get \$RP)</strong></a><br /><br />Or, if you need help with any of those two options I listed above, just send me a reply and I'll do my best to help you out!<br /><br />Thanks for using Rayku.com!<br />Bonnie Pang<br />Rayku Account Rep<br /><br />http://www.rayku.com</p>");
					
						$this->mail->setContentType('text/html');
						$this->mail->addAddress($to);
						$this->mail->send();

					mysql_query("insert into points_notify(userid,status) values(".$user->getId().", 1)", $connection) or die(mysql_error());

				      }

			

			} else {

                                        $connection = RaykuCommon::getDatabaseConnection();

			
					mysql_query("delete from points_notify where userid=".$user->getId(), $connection) or die(mysql_error());

			}



		return $this->renderText( get_partial('topNavNewUser'));
	} 


/*
	public function executeModelpopup()
	{


		if($_SESSION['modelPopupOpen'] && empty($_SESSION['popup_session'])) :

			$_SESSION['popup_session'] = 1;

		elseif($_SESSION['modelPopupOpen'] && !empty($_SESSION['popup_session'])) :

			unset($_SESSION['modelPopupOpen']);

			unset($_SESSION['popup_session']);


			$this->getResponse()->setCookie("popup_session", '',time()-300);
		endif;


		
		$this->redirect('http://www.rayku.com/dashboard');


	}*/

	public function executeRedirect()
	{

        $connection = RaykuCommon::getDatabaseConnection();

	$user = $this->getUser()->getRaykuUser();

	$query = mysql_query("select * from user_expert where user_id=".$user->getId(), $connection) or die(mysql_error());

	$chat_query = mysql_query("select * from sendmessage where asker_id=".$user->getId(), $connection) or die(mysql_error());

	$expertResponse = mysql_num_rows($query);

	$chatResponse = mysql_num_rows($chat_query);



	if(empty($chatResponse) && empty($expertResponse)) {

		if(!empty($_COOKIE['redirection'])) {

			$redirectvalue = "redirect";

			echo $redirectvalue;

		}

	}


		exit(0);

	} 


	/*public function executeCheckpoints()
	{

				$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());
				$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

		sfProjectConfiguration::getActive()->loadHelpers('Partial');

		$user = $this->getUser()->getRaykuUser();
		
			if($user->getPoints() < 2) {

					$query = mysql_query("select * from points_notify where userid=".$user->getId()) or die(mysql_error());

					if(mysql_num_rows($query) == 0) {

						$this->mail = Mailman::createCleanMailer();
						$this->mail->setSubject('Rayku Points Notify');
						$this->mail->setFrom('Admin < admin@rayku.com >');
						$to = $user->getEmail(); 
					
						$this->mail->setBody( "<p> Purchase Rayku Points From Rayku Shop : <a href='http://www.rayku.com/shop/paypal'> <strong> Rayku Points </strong></a></p>");
					
						$this->mail->setContentType('text/html');
						$this->mail->addAddress($to);
						$this->mail->send();

					mysql_query("insert into points_notify(userid,status) values(".$user->getId().", 1)") or die(mysql_error());

				      }

			

			} else {

			
					mysql_query("delete from points_notify where userid=".$user->getId()) or die(mysql_error());

			}

	} */

	
	public function executeTest() 
	{
	
		sfProjectConfiguration::getActive()->loadHelpers('Partial');
		
		$email= $this->getRequestParameter('email');
		
		$mailer_1=explode('@', $email); 
		
		$mailer_2= explode('.',$mailer_1[1]) ;
		
		$webmailer = $mailer_2[0];   
		
		 require_once('/home/rayku/lib/OpenInviter/openinviter.php');
		
		$user = $this->getUser()->getRaykuUser();
	   // passing to view
		$this->user = $user;		
		/* getting all email providers array */	

		$inviter=new OpenInviter();
		$oi_services=$inviter->getPlugins();
		$this->email = array();
		foreach ($oi_services as $type=>$providers)	
			{									
				foreach ($providers as $provider=>$details)
					$this->email[$provider] = $details['name'];
						
				/* exit when socail networking starts */
				break;		
			}
		
		
		return $this->renderText(get_partial('webmailer', array('mailer' => $webmailer ,'email' => $this->email ))); 
		
	}
		
	
}
