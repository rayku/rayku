<?php

$EmailTo = "john@rayku.com";
$Subject = "Tutor Application a1";
$Name = Trim(stripslashes($_POST['Name'])); 
$Email = Trim(stripslashes($_POST['Email'])); 
$School = Trim(stripslashes($_POST['School'])); 
$Year = Trim(stripslashes($_POST['Year'])); 
$GPA = Trim(stripslashes($_POST['GPA'])); 

// validation
$validationOK=true;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=http://www.rayku.com/certification/error\">";
  exit;
}

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $Email;
$Body .= "\n";
$Body .= "School: ";
$Body .= $School;
$Body .= "\n";
$Body .= "Year: ";
$Body .= $Year;
$Body .= "\n";
$Body .= "GPA: ";
$Body .= $GPA;
$Body .= "\n";

// send email 
$success = mail($EmailTo, $Subject, $Body, "From: <$Email>");

// redirect to success page 
if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=http://www.rayku.com/certification/applied\">";
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=http://www.rayku.com/certification/error\">";
}
?>