<?php

class userActions extends sfActions
{

    public function executeAutocomplete()
    {
        $this->users = UserPeer::getWithMatchingUsername(
            $this->getRequestParameter('name'),
            sfConfig::get('app_users_autocomplete_limit')
        );
    }
    
    public function executeSetWWWOnlineStatusToIdle()
    {
        $raykuUser = $this->getUser()->getRaykuUser();
        $raykuUser->setWWWOnlineStatus(User::WWW_ONLINE_STATUS_IDLE);
        $raykuUser->save();
    }

    public function executeSetWWWOnlineStatusToActive()
    {
        $raykuUser = $this->getUser()->getRaykuUser();
        $raykuUser->setWWWOnlineStatus(User::WWW_ONLINE_STATUS_ACTIVE);
        $raykuUser->save();
        
        $this->redirect('dashboard/index');
    }
}
