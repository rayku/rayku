<?php

/**
 * invitation actions.
 *
 * @package    elifes
 * @subpackage invitation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class invitationActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {

  }

  public function executeSendConfirmation()
  {
    //Store the user's e-mail address
    $this->email = $this->getRequestParameter('email');

			$myValidator = new sfEmailValidator();

			$myValidator->initialize($this->getContext());

			if(!$myValidator->execute($this->email, $err_msg))
			{
				$this->msg="2";
				return sfView::ERROR;
			}

			//Setup the criteria
			$c = new Criteria();
			$c->add(UserPeer::EMAIL, $this->getRequestParameter('email'));

			//Load the user
			$user = UserPeer::doSelectOne($c);

      //If the user doesn't exist, display an error
     if($user)
     {
      $this->msg="3";
      return sfView::ERROR;
     }

       // Generate Code
     $this->code = UserPeer::generateInvitationHash( $this->getUser()->getRaykuUser() );

     $this->mail = new sfMail();

		 //Set the to, from, and subject headers
		  $this->mail->addAddress($this->getRequestParameter('email'));

		  $this->mail->setFrom('Rayku Administration < admin@rayku.com >');

		  $this->mail->setSubject('Rayku Teacher Invitation');

      sfProjectConfiguration::getActive()->loadHelpers('Url');
      $invitationLink = url_for( 'register/index?utype=2', true );
      $invitationLink = str_replace( '_dev', '', $invitationLink );
      $invitationLink = str_replace( 'admin.php/', '', $invitationLink );

		  $this->mail->setBody('Hello,
		  You have been recommended by a colleague or friend into the Rayku teacher account program.
		  To find out more, please visit us at www.rayku.com.

		  To accept this invitation, please enter the below invitation code when you are register using the link below.

		  Registration link: '.$invitationLink.'

		  Invitation Code: '.$this->code.'

		  Thank you for your time,
		  Rayku Administration');

		  //Send the e-mail off

		  $this->mail->send() ;
  }
}