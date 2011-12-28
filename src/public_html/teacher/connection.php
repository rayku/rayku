<?php
$con = mysql_connect("localhost","root");
$my_db="whiteboard";
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("$my_db", $con); 
?>
