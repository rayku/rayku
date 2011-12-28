<?php

	$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
	$db = mysql_select_db("rayku_db", $con);

	$getUser = mysql_query("select u.id, us.score, us.user_id from user as u, user_score as us where u.id = us.user_id ") or die("Error---1".mysql_error());

	$i = 1;

	while($rowUser = mysql_fetch_assoc($getUser)) {

		if(!empty($rowUser['score'])) {

			$_Users[$i] = array("score" => $rowUser['score'], "userid" => $rowUser['id']);
		
			$i++;

		}

	}


	asort($_Users);  

	arsort($_Users);



//echo key($_Users); To get top user index key value

	$topUserIndex = key($_Users);

	$x = $_Users[$topUserIndex]['score']; // Top User ES


	foreach($_Users as $key => $user) :

		$a = $user['score'] / $x;

		$_score  = $a * 2000;
		
		mysql_query("update user_score set score = ".$_score." where user_id=".$user['userid']) or die("Error---3".mysql_error()); // Update squeezing score

		$a = ''; $_score = '';

	endforeach;


	


?>
