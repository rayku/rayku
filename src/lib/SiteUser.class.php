<?php
/**
 * Common class for symfony "session" user object
 *
 * @author lukas
 */
class SiteUser extends sfBasicSecurityUser
{
  /**
   * @var User
   */
  private static $raykuUser = null;

  /**
   * Returns logged person User object from database
   *
   * @return User
   */
  public function getRaykuUser()
  {
    if( is_null( self::$raykuUser ) )
		  self::$raykuUser = UserPeer::retrieveByPK($this->getRaykuUserId());

    return self::$raykuUser;
  }

  /**
   * Returns logged person User object id
   */
  public function getRaykuUserId()
  {
    return $this->getAttribute('user_id', null);
  }

	/**
	 * Reset the last activity time for a user to now
	 *
	 * @return boolean If successful
	 */
	public function updateLastActivity()
	{
		if (!$this->isAuthenticated())
		{
			return false;
		}

		$user = $this->getRaykuUser();
		$user->setLastActivityAt(time());
		$user->save();

		return true;
	}

	/**
	 * sign in, set the remember key if necessary
	 *
	 * @param User $user
	 * @param boolean $rememberMe
	 */
	public function signIn(User $user, $rememberMe = false)
	{
		$this->setAuthenticated(true);
    $this->setUserTypeCredentials( $user->getType() );

		if ($rememberMe)
		{
			$cookie_key = MyTools::generateRandomKey();

			$user->setCookieKey($cookie_key);
			$user->save();

			$value = base64_encode(serialize(array($cookie_key, $user->getUsername())));
			sfContext::getInstance()->getResponse()->setCookie('rayku', $value, time() + 60 * 60 * 24 * 15, '/');
		}

		$this->setAttribute('user_id', $user->getId());
	}

	public function signOut()
	{
		sfContext::getInstance()->getResponse()->setCookie('rayku', '', time() - 31536000, '/');
    $this->clearCredentials();
		$this->setAuthenticated(false);
		$this->setAttribute('user_id', null);
	}

	public function addNotice($message)
	{
		$this->addMessage('notices', $message);
	}

	public function addError($message)
	{
		$this->addMessage('errors', $message);
	}

	public function addMessage($name, $message)
	{
		$messages = $this->getAttribute($name, null, 'symfony/flash');

		$messages[] = $message;

		$this->setAttribute($name, $messages, 'symfony/flash');
		$this->setAttribute($name, true, 'symfony/flash/remove');
	}

  protected function setUserTypeCredentials( $userType )
  {
    $credentials = array();
    switch( $userType )
    {
      case UserPeer::getTypeFromValue( 'teacher' ):
          $credentials[] = 'teacher';
        break;
      case UserPeer::getTypeFromValue( 'admin' ):
          $credentials[] = 'admin';
        break;
      case UserPeer::getTypeFromValue( 'expert' ):
          $credentials[] = 'expert';
        break;
      case UserPeer::getTypeFromValue( 'user' ):
          $credentials[] = 'student';
        break;
    }

    $this->clearCredentials();
    $this->addCredentials( $credentials );
  }
}
?>
