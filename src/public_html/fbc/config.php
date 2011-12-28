<?php
mysql_connect("localhost","rayku","TPx6izAvK38M") or die(mysql_error()); //database connection
mysql_select_db("rayku_db")or die(mysql_error());//database name
$message="test status"; //facebook status to post
$redirect="http://abcd.com"; //redirect after complete
$apik="651ce7d20d60fd33371fa21e5d473923";
$seck="720072cfe458392fbb2e6c0fce37f054";
$copydir = "/home/rayku/public_html/fbc/fbimage/"; //store facebook image
$process_url="http://www.rayku.com/fbc/process_profile.php"; //process file
?>