<?php

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
		$db = mysql_select_db("rayku_db", $con);



	$time = time()-300;

mysql_query("delete from user_expert where time <= ".$time." ") or die("Expert Delete Error:--->".mysql_error());

mysql_query("delete from sendmessage where time <= ".$time." ") or die("Asker Delete Error:--->".mysql_error());



	



?>
