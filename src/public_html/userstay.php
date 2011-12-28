<?php

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

	$queryStay = mysql_query("select * from user_stay as us, user as u where us.user_id = u.id") or die("Error--->1".mysql_error());

	while($rowStay = mysql_fetch_assoc($queryStay)) {
	
		$score = ''; $finalScore = '';

		$score = $rowStay['stay'] * 6;

		$queryScore = mysql_query("select * from user_score where user_id=".$rowStay["user_id"]) or die("Error--->2".mysql_error());

		if(mysql_num_rows($queryScore)) :

			$rowScore = mysql_fetch_assoc($queryScore);

			$finalScore =  $rowScore['score'] + $score;

			$updateScore = mysql_query("update user_score set score = ".$finalScore." where user_id=".$rowStay["user_id"]) or die("Error--->3".mysql_error());

		else :

			mysql_query("insert into user_score(user_id,score) values(".$rowStay["user_id"].", ".$score.")");

		endif;

	mysql_query("delete from user_stay where user_id=".$rowStay["user_id"]) or die("Error--->4".mysql_error());
		

	}

?>
