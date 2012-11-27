<?php

/**
 * referrals actions.
 *
 * @package    elifes
 * @subpackage referrals
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class referralsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->user = $this->getUser();

	//Form submitted
	if (sfWebRequest::POST == $this->getRequest()->getMethod()) {
		$emails  = $this->getRequestParameter('emails');
		$ref  = $this->getRequestParameter('ref');

		if(!$emails)
		{
			echo "Invalid emails";
			return false;
		}


        $mail = Mailman::createMailer();
        $mail->setContentType('text/html');
        $mail->addAddress( $emails );
        $mail->setSubject('Invitation');
        sfProjectConfiguration::getActive()->loadHelpers(array('Asset','Url','Partial'));
        $mail->setBody(
            get_partial(
                'invitationEmailHtml',
                array('ref' => $ref,
                'user' => $user)));
        $mail->send();


	//$this->forward('referrals', 'invitesSent');

	}


  }



  public function executeInvitesSent(sfWebRequest $request)
	{

	}

}
