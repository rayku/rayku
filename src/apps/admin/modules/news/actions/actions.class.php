<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class newsActions extends sfActions
{
  public function executeIndex()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
         $db = mysql_select_db("rayku_db", $con);

		//mysql_query("CREATE TABLE news_update(id int( 10 ) AUTO_INCREMENT PRIMARY KEY ,title varchar( 255 ) NOT NULL ,description varchar( 255 ) NOT NULL)") or die(mysql_error());

//mysql_query("INSERT INTO `news_update` (`id`, `title`, `description`) VALUES ('1', 'Testing', 'Hi this is first news'), ('2', 'Testing 2', 'This is second News')") or die(mysql_error());

$query = mysql_query("select * from news_update") or die(mysql_error());

$allNews = array();

$i = 0;

	while($row = mysql_fetch_array($query)) {

		$allNews[$i] = array("id"=> $row['id'], "title" => $row['title'], "description" => $row['description']);

	$i++;

	}

$this->allNews = $allNews;
	
  }


  public function executeNew()
  {
   
	
  }

  public function executeCreate()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
        $db = mysql_select_db("rayku_db", $con);

	mysql_query("INSERT INTO `news_update` (`title`, `description`) VALUES ('".$_POST['news']['title']."', '".$_POST['news']['description']."')") or die(mysql_error());

     $this->redirect('news/index');

  }

  public function executeEdit()
  {
	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
        $db = mysql_select_db("rayku_db", $con);

   	$id = explode("/", $_SERVER['REQUEST_URI']);

	$query = mysql_query("select * from news_update where id=".$id['5']) or die(mysql_error());

$row = mysql_fetch_array($query);

$allNews = array();


$allNews = array("id"=> $row['id'], "title" => $row['title'], "description" => $row['description']);



 	$this->allNews = $allNews;

  }


  public function executeUpdate()
  {



	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
        $db = mysql_select_db("rayku_db", $con);

	mysql_query("Update `news_update` set title = '".$_POST['news']['title']."', description = '".$_POST['news']['description']."' where id=".$_POST['news']['id']) or die(mysql_error());

     $this->redirect('news/index');

  }

  public function executeDelete()
  {

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
        $db = mysql_select_db("rayku_db", $con);


	mysql_query("delete from news_update where id=".$_POST['news']['id']) or die(mysql_error());

    	 $this->redirect('news/index');

  }


}
