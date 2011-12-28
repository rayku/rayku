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

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
         $db = mysql_select_db("rayku_db", $con);



	
  }

  public function executeCategory()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
         $db = mysql_select_db("rayku_db", $con);


	if(!empty($_GET['id'])) : 
	
		$_Category = mysql_query("delete from expert_category where id = ".$_GET['id']."") or die(mysql_error());

	endif;

	

  }

  public function executeUsers()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
         $db = mysql_select_db("rayku_db", $con);


	if(!empty($_GET['id'])) : 
	
		
		$_Category = mysql_query("delete from expert_category where user_id = ".$_GET['id']."") or die(mysql_error());

		$_Users = mysql_query("delete from user where id = ".$_GET['id']."") or die(mysql_error());

	endif;

	

  }



}
