<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class threadsActions extends sfActions
{
    public function executeIndex()
    {

        $connection = RaykuCommon::getDatabaseConnection();
        if($_GET['ban_id']<>'')
        {

            $_query = mysql_query("update thread set banned=1  where id=".$_REQUEST['ban_id'], $connection) or die(mysql_error());
        }
        if($_GET['unban_id']<>'')
        {
            $_query = mysql_query("update thread set banned=0  where id=".$_REQUEST['unban_id'], $connection) or die(mysql_error());
        }

        $limit=10;
        $page = $_GET['page'];
        if($page)
            $start = ($page - 1) * $limit;
        else
            $start = 0;

        $_query = mysql_query("select * from thread  order by  created_at desc limit $start,10", $connection) or die(mysql_error());

        $allChat = array();

        $i = 0;



        while($_row = mysql_fetch_array($_query)) {

            $IP=$_row['user_ip']<>''?$_row['user_ip']:'Not Available';
            $allChat[$i] = array("id"=> $_row['id'], "poster_id" => $_row['poster_id'], "title" => $_row['title'], "user_ip"=>$IP, "date" => $_row['created_at']);

            if($_row['banned']==0)
            {
                $allChat[$i]['banned']="<a  href='http://www.rayku.com/admin.php/threads?page=".$_GET['page']."&ban_id=".$_row['id']."'>Ban</a> ";
            }
            else
            {
                $allChat[$i]['banned']="<a  href='http://www.rayku.com/admin.php/threads?page=".$_GET['page']."&unban_id=".$_row['id']."'>Un-Ban</a> ";
            }

            $i++;

        }


        $this->allChat = $allChat;



    }
    public function executeBanuser()
    {

        echo $threadId = $this->getRequestParameter('id');
die;

    }



}
