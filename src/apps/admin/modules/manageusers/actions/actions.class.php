<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class manageusersActions extends sfActions
{
  public function executeIndex()
  {

  }

  public function executeCategory()
  {


		$connection = RaykuCommon::getDatabaseConnection();
	if(!empty($_GET['id'])) :

		$_Category = mysql_query("delete from expert_category where id = ".$_GET['id']."", $connection) or die(mysql_error());

	endif;



  }

  public function executeUsers()
  {


		$connection = RaykuCommon::getDatabaseConnection();

	if(!empty($_GET['id'])) :


		$_Category = mysql_query("delete from expert_category where user_id = ".$_GET['id']."", $connection) or die(mysql_error());

		$_Users = mysql_query("delete from user where id = ".$_GET['id']."", $connection) or die(mysql_error());

	endif;



  }



}
