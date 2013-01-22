<?php

/**
 * default actions.
 *
 * @package    elifes
 * @subpackage default
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class defaultActions extends sfActions
{
  function executeIndex()
  {
  }

  function executeLogin()
  {
    $this->redirect( "http://$_SERVER[HTTP_HOST]/login" );
  }
  function executeSecure()
  {
  }

  function executeError404()
  {
    
  }
}
