<?php
/**
 * classroom actions.
 * @package    elifes
 * @subpackage classroom
 * @author     Dreamajax Technologies
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
*/
class classroomActions extends sfActions
{
  public function executeIndex()
  {
    if( $this->hasRequestParameter('id') )
    {
      $status = RaykuCommon::setCurrentClassroomId( $this->getRequestParameter( 'id' ),
                                                    $this->getUser() );

     if( $status )
     {
        /**
         * Thanks to redirect here we can be sure that in layout.php we have access to proper classroom object event in first request (in fact it is second request :))
         */
        $this->redirect( 'classroom/index' );
     }
     else
       $this->forward404();
    }
    
    $this->classroom = RaykuCommon::getCurrentClassroom( $this->getUser() );

    $this->forward404Unless( is_object( $this->classroom ) );
  }

  public function executeUnRole()
  {
    $c=new Criteria();
    $c->add(ClassroomMembersPeer::USER_ID,$this->getUser()->getRaykuUser()->getId());
    $c->add(ClassroomMembersPeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
    $classmember=ClassroomMembersPeer::doSelectOne($c);
    if($classmember)
    {
      $classmember->delete();
    }
  }

  public function executeHelp()
  {
    $this->classroom = RaykuCommon::getCurrentClassroom( $this->getUser() );
    $this->teacher = UserPeer::retrieveByPk($this->classroom->getUserId());

    $c = new Criteria();
    $c->add(LiveVideoChatPeer::RECEIVER_ID, $this->getUser()->getRaykuUserId());
    $c->add(LiveVideoChatPeer::SENDER_ID, $this->classroom->getUserId());
    $c->add(LiveVideoChatPeer::CLASSROOM_ID, $this->classroom->getId());
  
    $this->chatapproved = LiveVideoChatPeer::doSelectOne($c);
  }


  public function executeVideorequest()
  {
    if( $this->getRequestParameter('teacher_id') )
    {
      $livevideochat = new LiveVideoChat();

      $livevideochat->setReceiverId($this->getUser()->getRaykuUserId());
      $livevideochat->setSenderId($this->getRequestParameter('teacher_id'));
      $livevideochat->setClassroomId( RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
      $livevideochat->setApproved(0);

      if($livevideochat->save())
      {
        return $this->renderText('Request Send to Teacher');
      }
      else
      {
        return $this->renderText('There is some problem while processing');
      }
    }
  }

  public function executeCheckvideorequest()
  {
    sfProjectConfiguration::getActive()->loadHelpers('Partial');
    $c = new Criteria();
    $c->add(LiveVideoChatPeer::SENDER_ID, $this->getUser()->getRaykuUserId());
    $c->add(LiveVideoChatPeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
    $c->add(LiveVideoChatPeer::APPROVED, 0);
    $this->voicechatlist = LiveVideoChatPeer::doSelect($c);

    return $this->renderText(get_partial('classroom/chatrequestalert', array('voicechatlist' => $this->voicechatlist)));
  }

  public function executeAcceptchat()
  {
    $c = new Criteria();
    $c->add(LiveVideoChatPeer::RECEIVER_ID, $this->getRequestParameter('receiver_id'));
    $c->add(LiveVideoChatPeer::SENDER_ID, $this->getUser()->getRaykuUserId());
    $c->add(LiveVideoChatPeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );

    $videochatrecord = LiveVideoChatPeer::doSelectOne($c);

    if($videochatrecord)
    {
      $videochatrecord->setApproved(1);
      $videochatrecord->save();
    }

    return $this->renderText('Chat requested accepted');
  }
  
  public function executeResetEmail()
  {
  
  		 $this->classroom = RaykuCommon::getCurrentClassroom( $this->getUser() ); 
		 
		 $this->email=  $this->classroom->getClassroomEmail();
   
  }
  public function executeClassroomemail()
  {
  		
  		$this->classroom = RaykuCommon::getCurrentClassroom( $this->getUser() ); 

		$cpuser = 'rayku'; // cPanel username
		$cppass = 'indiaca45445'; // cPanel password
		$cpdomain = 'rayku.com'; // cPanel domain or IP
		$cpskin = 'x3';  // cPanel skin. Mostly x or x2. 
		$edomain = 'rayku.com'; // email domain (usually same as cPanel domain above)
    	$equota = 5; // amount of space in megabytes 
		
		$email=  $this->classroom->getClassroomEmail(); 

	//	$email ='dynamics.dynamics@rayku.com'; 
		
		if($email != NULL)
		{
		  
		   $s = curl_init();
	       curl_setopt($s,CURLOPT_URL,"http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/realdelpop.html?domain=$edomain&email=$email");
     	  curl_exec($s); 
		 curl_close($s); 
		  
		 @fopen ("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/realdelpop.html?domain=$edomain&email=$email", "r");
			
		 /*  @fopen("http://".$cpuser.":".$cppass."@".$cpdomain.":2082/frontend/$cpskin/mail/realdelpop.html?domain=".$cpdomain."&email=".$email, "r") or die("Error.");
		      echo "Email deleted"; */
	 	}  
		
		$mail_1_user = $this->classroom->getClassroomEmail(); 
		$newemail= $this->classroom->getClassUsername().'.'.$this->classroom->getEmailPasscode().'@rayku.com'; 
		
		if($newemail == $mail_1_user) 
		{
			$newemail= $this->classroom->getEmailPasscode().'.'.$this->classroom->getClassUsername().'@rayku.com'; 
		}
		
	    
		 $temp = explode('@rayku.com',$newemail);
		 
		 $euser = $temp[0];
		
		 $epass = $this->classroom->getEmailPasscode();
		
		 $f = fopen ("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", "r");
		 
				  while (!feof ($f))
				  {
					$line = fgets ($f, 1024);
					if (ereg ("already exists", $line, $out))
					{
					  break;
					}
				  }
			
				  @fclose($f);
							 
				  $generatedmail= $euser.'@rayku.com'  ;
				  
				  $this->classroom->setClassroomEmail($generatedmail); 
				  $this->classroom->save();  
				  
	
		
	//	$this->redirect('classroom/resetEmail');
	
  
  }
  
  public function executeEmailinfo()
  {
  
  }
  
  
}