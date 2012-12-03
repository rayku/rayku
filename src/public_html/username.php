<?php


		$con = mysql_connect("db1.p.rayku.com", "rayku_db", "UthmCRtaum34qpGL");
	        $db = mysql_select_db("rayku_db", $con);
	//$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

$queryName = mysql_query("select * from user where username='".$_COOKIE['username']."' ") or die(mysql_error());



if(mysql_num_rows($queryName) > 0) {
		
		echo "name";

} else {
	
	echo "else";
}



?>
