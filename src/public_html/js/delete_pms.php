<?php

if($_GET['deletemessages']<>'')
{
	
	
		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

		$message_id=explode(",",$_GET['deletemessages']);
		//print_r($message_id);
		foreach($message_id as $id)
		{
			if($id<>'')
			{
			$query = mysql_query("delete from private_message where id='". $id."'") or die(mysql_error());
			}
		}	
}
else
{
	echo "0";
}
?>