<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class massmailActions extends sfActions
{
  public function executeIndex()
  {

	if($_SESSION['mailsent']) :

		$this->flag = 1;
			
 		unset($_SESSION['mailsent']);

	endif;



	
  }

  public function executeSendmail()
  {

		$c = new Criteria();
		$users = UserPeer::doSelect($c);

		foreach($users as $user) :


					$this->mail = Mailman::createCleanMailer();

					$subject = $_POST['massmail_subject'];

					$this->mail->setSubject($subject);
					$this->mail->setFrom("Rayku < admin@rayku.com >");
					$to = $user->getEmail();

					sfProjectConfiguration::getActive()->loadHelpers(array('Partial'));

					$this->mail->setBody($_POST['massmail_content']);
					
					$this->mail->setContentType('text/html');
					$this->mail->addAddress($to);
					$this->mail->send();



			if($this->mail) :

				$_SESSION['mailsent'] = 1;

			endif;


		endforeach;


     $this->redirect('massmail/index');
	
  }



}
