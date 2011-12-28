<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class featuredActions extends sfActions
{
  public function executeIndex()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
         $db = mysql_select_db("rayku_db", $con);


$query = mysql_query("select * from item") or die(mysql_error());

$allItem = array();

$i = 0;

	while($row = mysql_fetch_array($query)) {

		$allItem[$i] = array("id"=> $row['id'], "title" => $row['title'], "description" => $row['description']);

	$i++;

	}

$this->allItem = $allItem;
	
  }


  public function executeUpdate()
  {

	$id = explode("/",$_SERVER['REQUEST_URI']);


	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
        $db = mysql_select_db("rayku_db", $con);

	$query = mysql_query("select * from item_featured where item_id =".$id[5]." and status=1") or die(mysql_error());

	if(mysql_num_rows($query) > 0) {

		mysql_query("delete from `item_featured` where item_id =".$id[5]) or die(mysql_error());

	} else {

		mysql_query("insert into item_featured(item_id, status) values(".$id[5].", 1) ") or die(mysql_error());

	}

     $this->redirect('featured/index');

  }

}
