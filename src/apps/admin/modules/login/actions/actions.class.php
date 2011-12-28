<?php 
/**
 * login actions.
 *
 * @package    elifes
 * @subpackage login
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class loginActions extends sfActions
{
	/**
	* Executes index action
	*
	*/
	
	public function executeIndex()
	{
		//If the user is logged in, don't let them login again
		if($this->getUser()->isAuthenticated())
			return sfView::ERROR;
	}
	
	
	public function executeLoginCheck()
	{
		//Check the user credentials
		$c = new Criteria();
		$c->add(UserPeer::USERNAME, $this->getRequestParameter('username'));
		$c->add(UserPeer::PASSWORD, sha1($this->getRequestParameter('password')));
		
		//If the credentials failed, display a login failed message
		if(!$this->user = UserPeer::doSelectOne($c))
		{
			$this->msg = 'Your username and password were incorrect.';
			
			return sfView::ERROR;
		}
			
		//If the user hasn't confirmed their account, display a message
		if($this->user->getType() == UserPeer::getTypeFromValue('unconfirmed'))
		{
			$this->msg = 'You have not yet confirmed your account e-mail address. Please check your e-mail for confirmation instructions.';
			
			return sfView::ERROR;
		}
		
		//If the user is banned, display a message
		if($this->user->getHidden())
		{
			$this->msg = 'You are currently banned.';
			
			return sfView::ERROR;
		}

		//for admin login
		if($this->user->getType() == 4)
		{
			$this->getUser()->signIn($this->user, $this->getRequestParameter('remember', false));
			return sfView::SUCCESS;
		}
		else
		{
			$this->msg = 'You are not an admin.';
			
			return sfView::ERROR;
		}
		
	
	}
	
	public function executeLogout()
	{
	   	$this->getUser()->signOut();

		$this->redirect('@homepage');
	}

  public function executeSecure()
  {
  }
		
		
}
