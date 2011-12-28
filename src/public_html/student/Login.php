<?php
/*session_start();
include "connection.php";

$userid = $_POST['userid'];
$usrpassword = $_POST['password'];
             
$query = "SELECT * FROM  student WHERE userid='$userid' AND userpassword = '$usrpassword'";


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
  */
 session_start();
$userid = $_POST['userid'];
$usrpassword = $_POST['password'];
?>
<login>
<?php
if($userid=='student1' && $usrpassword =='student1'){
?>

		<adminid>student1</adminid>
		<loginresult>yes</loginresult>

<?php
}
else if($userid=='student2' && $usrpassword =='student2'){
?>

		<adminid>student2</adminid>
		<loginresult>yes</loginresult>

<?php
}
else if($userid=='student3' && $usrpassword =='student3'){
?>

		<adminid>student3</adminid>
		<loginresult>yes</loginresult>

<?php
}
else{
?>
		<adminid></adminid>
		<loginresult>no</loginresult>

<?php
}
?>
</login>