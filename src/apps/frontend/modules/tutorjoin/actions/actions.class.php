<?php

/**
 * tutorjoin actions.
 *
 * @package    elifes
 * @subpackage tutorjoin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class tutorjoinActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->getResponse()->setCookie('wherefind', 'Ayse called me', null, '/', sfConfig::get('app_cookies_domain'));
  }
  
  public function executeApplied()
  {
	  
  }
   
  public function errorApplied()
  {
	  
  } 
}
