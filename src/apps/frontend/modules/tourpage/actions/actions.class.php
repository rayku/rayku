<?php

/**
 * login actions.
 *
 * @package    elifes
 * @subpackage login
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */


class tourpageActions extends sfActions
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
		
	}	

	public function executeLogout()
	{
	   	$this->getUser()->signOut();

		$this->redirect('@homepage');
	}	
}
