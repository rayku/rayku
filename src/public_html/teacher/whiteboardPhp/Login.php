<?php
session_start();
include "connection.php";

$userid = $_POST['userid'];
$usrpassword = $_POST['password'];
             
$query = "SELECT * FROM  teacher WHERE userid='$userid' AND userpassword = '$usrpassword'";


$row=mysql_fetch_array(mysql_query($query));

// Assign a value to the session-variable
$_SESSION["admin_logged_on"] = $userid;

//start outputting the XML

$output = "<login>";
//if the query returned true, the output <loginsuccess>yes</loginsuccess> else output <loginsuccess>no</loginsuccess>
	$output .= "<adminid>". $_SESSION["admin_logged_on"]."</adminid>";
	$output .= "<loginresult>";
		if(!$row){
		$output .= "no"; 
		
		}else{
		
		$output .= "yes"; 
		
		}
	$output .= "</loginresult>";
$output .= "</login>";

//output all the XML
echo ($output);


?>

