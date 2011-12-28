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
    $sEmail = $this->getRequestParameter('email');

    $myValidator = new sfEmailValidator();
    $myValidator->initialize($this->getContext());

    if(!$myValidator->execute($sEmail, $err_msg)) {

      $this->msg="2";
      return sfView::ERROR;
    }

    $user = UserPeer::getByEmail( $sEmail );
    if( $user )
    {
      $this->msg="3";
      return sfView::ERROR;
    }

    if( InvitationPeer::hasUserInvitedEmail( $this->getUser()->getRaykuUser(), $sEmail ) )
    {
      $this->msg="4";
      return sfView::ERROR;
    }

    $sHash = UserPeer::generateInvitationHash( $this->getUser()->getRaykuUser() );

    $invitation=new Invitation();
    $invitation->setUserId($this->getUser()->getRaykuUserId());
    $invitation->setReceiverEmail( $sEmail );
    $invitation->setReceiverCode( $sHash );
    $invitation->setSent('0');
    $invitation->save();

    $this->sendInvitationEmail( $sHash );
  }

  private function sendInvitationEmail( $activationCode )
  {
    $this->mail = Mailman::createMailer();

    $this->mail->addAddress( $this->getRequestParameter('email') );
    $this->mail->setSubject('Teacher account invitation');

    sfProjectConfiguration::getActive()->loadHelpers(array('Url','Partial'));
    $emailParameters = array(
            'code' => $activationCode,
            'invitationLink' => url_for( 'register/index?utype=2', true) );

    $this->mail->setBody( get_partial('confirmationEmail', $emailParameters ) );
    
    $this->mail->send() ;
  }
}
