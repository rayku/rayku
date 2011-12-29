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


        $connection = RaykuCommon::getDatabaseConnection();

        $query = mysql_query("select * from news_update", $connection) or die(mysql_error());

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


        $connection = RaykuCommon::getDatabaseConnection();
        mysql_query("INSERT INTO `news_update` (`title`, `description`) VALUES ('".$_POST['news']['title']."', '".$_POST['news']['description']."')", $connection) or die(mysql_error());

        $this->redirect('news/index');

    }

    public function executeEdit()
    {

        $connection = RaykuCommon::getDatabaseConnection();
        $id = explode("/", $_SERVER['REQUEST_URI']);

        $query = mysql_query("select * from news_update where id=".$id['5'], $connection) or die(mysql_error());

        $row = mysql_fetch_array($query);

        $allNews = array();


        $allNews = array("id"=> $row['id'], "title" => $row['title'], "description" => $row['description']);



        $this->allNews = $allNews;

    }


    public function executeUpdate()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        mysql_query("Update `news_update` set title = '".$_POST['news']['title']."', description = '".$_POST['news']['description']."' where id=".$_POST['news']['id'], $connection) or die(mysql_error());

        $this->redirect('news/index');

    }

    public function executeDelete()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        mysql_query("delete from news_update where id=".$_POST['news']['id'], $connection) or die(mysql_error());
        $this->redirect('news/index');
    }
}
