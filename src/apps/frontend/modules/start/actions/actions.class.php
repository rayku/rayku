<?php

/**
 * start actions.
 *
 * @package    elifes
 * @subpackage start
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class startActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $context = $this->getContext();
      $sfUser = $context->getUser();
      if($sfUser->isAuthenticated()){
        $this->redirect('/dashboard');
      }
   	// $this->forward('default', 'module');
  }
}
