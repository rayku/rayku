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
}
