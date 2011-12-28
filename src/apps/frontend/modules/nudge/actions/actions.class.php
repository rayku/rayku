<?php

/**
 * nudge actions.
 *
 * @package    elifes
 * @subpackage nudge
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class nudgeActions extends sfActions
{
	public function executeSend()
	{


		
		$c = new Criteria();
		$c->add(UserPeer::USERNAME,$this->getRequestParameter('username'));
	 	$user = UserPeer::doSelectOne($c);
	
		
		//$user = UserPeer::getByUsername($this->getRequestParameter('username'));
		
		// make sure it's a valid user
	/*	if (!$user instanceof User)
		{
			$this->error = 'No such user exists.';
			$this->setTemplate('_error');
			return sfView::SUCCESS;
		}*/

    if( $this->getUser()->getRaykuUserId() == $user->getId() )
    {
			$this->error = "You can't nudge yourself. Click <a href='javascript:history.go(-1)'>here</a> to go back.";
			$this->setTemplate('_error');
			return sfView::SUCCESS;
    }
		
		// removing existing nudges from this user (to requested user)
		$user->removeNudgesFromUser($this->getUser()->getRaykuUser());
		
		// create new nudge
		$nudge = new Nudge();
		$nudge->setUserFromId($this->getUser()->getRaykuUserId());
		$nudge->setUserToId($user->getId());
		$nudge->save();
		
		$this->message='Nudge sent to ' . $user->getName() . '. Click <a href="javascript:history.go(-1)">here</a> to go back.';
		
		// $this->redirect('@profile?username=' . $user->getUsername());
	}
	
	public function executeRemove()
	{



		$user = UserPeer::getByUsername($this->getRequestParameter('username'));
		
		// make sure it's a valid user
		/*if (!$user instanceof User)
		{
			$this->error = 'No such user exists.';
			$this->setTemplate('_error');
			return sfView::SUCCESS;
		}
		*/
		$nudges = $this->getUser()->getRaykuUser()->removeNudgesFromUser($user);

/*		if( !$nudges )
		{
		  $this->error = 'No nudges';
				$this->setTemplate('_error');
				return sfView::SUCCESS;
		}
*/		
		$this->redirect('@profile?username=' . $this->getUser()->getRaykuUser()->getUsername());
	} 
	
	
	
}
