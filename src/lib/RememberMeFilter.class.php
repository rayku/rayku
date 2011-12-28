<?php

class RememberMeFilter extends sfFilter
{
	public function execute($filterChain)
	{
    	// execute this filter only once
		if ($this->isFirstCall())
		{
      $user = sfContext::getInstance()->getUser();
      if( !$user->isAuthenticated() )
      {

        $cookie = $this->getContext()->getRequest()->getCookie('rayku');
        if( $cookie )
        {
          $value = unserialize(base64_decode($cookie));
          $c = new Criteria();
          $c->add(UserPeer::COOKIE_KEY, $value[0]);
          $c->add(UserPeer::USERNAME, $value[1]);
          $raykuUser = UserPeer::doSelectOne($c);
          if ($raykuUser instanceof User)
          {
            // sign in
            $user->signIn($raykuUser);
          }
        }
      }
		}
 
		// Execute next filter
		$filterChain->execute();
	}
}
