<?php

/**
 * Auth related API serivces
 */
class authActions extends sfActions
{
    
    /**
     * Simple check if given username/password are correct
     */
    public function executeCheckLogin(sfWebRequest $request)
    {
        $email = trim($request->getParameter('email'));
        $password = trim($request->getParameter('password'));
        if ($email == '' || $password == '') {
            return $this->renderText('FAIL');
        }
        
        $user = UserPeer::checkLogin($request->getParameter('email'), $request->getParameter('password'));
        
        return $this->renderText(($user instanceof User) ? 'OK' : 'FAIL');
    }
}
