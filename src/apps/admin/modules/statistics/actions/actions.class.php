<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class  statisticsActions extends sfActions
{
  public function executeIndex()
  {
    $connection = RaykuCommon::getDatabaseConnection();
  }

  public function executeAjaxstatistics()
  {
    $connection = RaykuCommon::getDatabaseConnection();
  }
}