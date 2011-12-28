<?php


$con = mysql_connect("localhost", "rayku_db", "db_*$%$%") or die(mysql_error());

$db = mysql_select_db("rayku_db", $con) or die(mysql_error());

$_username = trim($_GET['usr']);  $_password = trim($_GET['pwd']); 

if(!empty($_username) && !empty($_password)) {

	$_password = sha1($_password);

	$query = mysql_query("select * from user where email='".$_username."' and  password='".$_password."' ") or die(mysql_error());
	if(mysql_num_rows($query) > 0) {
		$users = mysql_fetch_assoc($query);

		header('HTTP/1.1 200 OK');

	} else {

		header('HTTP/1.1 401 Authorization Required');
	}

}  else {

	header('HTTP/1.1 401 Authorization Required');

	exit(0);

}


?>
