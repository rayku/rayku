<?php

/**
 * login actions.
 *
 * @package    elifes
 * @subpackage login
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */


class ryersonActions extends sfActions
{
	public $fb,$user,$session_key,$uid;

	/**
	* Action to display login page
	*/
	public function executeIndex()
	{
		//If the user is logged in, don't let them login again

		
	}	

	public function executeLogout()
	{
	   	$this->getUser()->signOut();

		$this->redirect('@homepage');
	}	
}
