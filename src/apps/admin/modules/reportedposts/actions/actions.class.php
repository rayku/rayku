<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class reportedpostsActions extends sfActions
{
  public function executeIndex()
  {






		$connection = RaykuCommon::getDatabaseConnection();
		 if($_GET['del_id']<>'')
		 {

			 $_query = mysql_query("delete from thread where id=".$_REQUEST['del_id'], $connection) ;
		 }
		  if($_GET['un_report_id']<>'')
		 {
			 $_query = mysql_query("update thread set reported=0  where id=".$_REQUEST['un_report_id'], $connection) ;
		 }

	$limit=10;
	$page = $_GET['page'];
	if($page)
		$start = ($page - 1) * $limit;
	else
		$start = 0;

$_query = mysql_query("select * from thread  where reported=1 order by  reported_date desc limit $start,10", $connection);

$repthreads = array();

$i = 0;



	while($_row = mysql_fetch_array($_query)) {

		$IP=$_row['user_ip']<>''?$_row['user_ip']:'Not Available';
		$repthreads[$i] = array("id"=> $_row['id'], "poster_id" => $_row['poster_id'], "title" => $_row['title'], "user_ip"=>$IP, "date" => $_row['reported_date']);


			$repthreads[$i]['delete']="<a  href='/admin.php/reportedposts?page=".$_GET['page']."&del_id=".$_row['id']."'>Delete Post</a> ";
			$repthreads[$i]['un_report']="<a  href='/admin.php/reportedposts?page=".$_GET['page']."&un_report_id=".$_row['id']."'>Unreport</a> ";
			$repthreads[$i]['viewthread']="<a  href='/forum/thread/".$_row['id']."/1'>View Thread</a> ";
	$i++;

	}


	$this->repthreads = $repthreads;








		 if($_GET['del_post_id']<>'')
		 {

			 $_query = mysql_query("delete from post where id=".$_REQUEST['del_post_id'], $connection) ;
		 }
		  if($_GET['un_report_post_id']<>'')
		 {
			 $_query = mysql_query("update post set reported=0  where id=".$_REQUEST['un_report_post_id'], $connection) ;
		 }

	$limit=10;
	$page = $_GET['page'];
	if($page)
		$start = ($page - 1) * $limit;
	else
		$start = 0;

$_query_post = mysql_query("select * from post  where reported=1 order by  reported_date desc limit $start,10", $connection) ;

$repposts = array();

$i = 0;



	while($_row = mysql_fetch_array($_query_post)) {

		$IP=$_row['user_ip']<>''?$_row['user_ip']:'Not Available';
		$repposts[$i] = array("id"=> $_row['id'], "poster_id" => $_row['poster_id'], "title" => substr($_row['content'],0,30), "user_ip"=>$IP, "date" => $_row['reported_date']);


			$repposts[$i]['delete']="<a  href='/admin.php/reportedposts?page=".$_GET['page']."&del_post_id=".$_row['id']."'>Delete Post</a> ";
			$repposts[$i]['un_report']="<a  href='/admin.php/reportedposts?page=".$_GET['page']."&un_report_post_id=".$_row['id']."'>Unreport</a> ";

			$repposts[$i]['viewthread']="<a  href='/forum/thread/".$_row['thread_id']."/1'>View Thread</a> ";

	$i++;

	}


	$this->repposts = $repposts;






  }




}
