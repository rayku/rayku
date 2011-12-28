<?php
session_start();
include "config.php";
$id = $_SESSION['tbid'];
echo $id;
    if(version_compare('5', PHP_VERSION, "<=")) require_once('facebook-platform/client/facebook.php');
    else                                        require_once('facebook-platform/php4client/facebook.php');    
$facebook = new Facebook($apik,$seck, null, true);    
$fb_uid = $facebook->require_login();
$fbuserarray = $facebook->api_client->users_getInfo($fb_uid, array('name','first_name','last_name','profile_url','contact_email', 'email_hashes','hometown_location','birthday_date','sex','relationship_status','about_me','activities','pic_big'));
$fbuser = $fbuserarray[0];
$hometown=$fbuser["hometown_location"]['city']." ".$fbuser["hometown_location"]['country'];
if($hometown!='')
mysql_query("UPDATE user SET hometown = '$hometown' where id='$id'");
$abtme=$fbuser['about_me'];
if($abtme!='')
mysql_query("UPDATE user SET about_me = '$abtme' where id='$id'");
if($fbuser['sex']=='male')
$sex=0;
else
$sex=1;
mysql_query("UPDATE user SET sex = '$sex' where id='$id'");
$rel=$fbuser['relationship_status'];
if($rel=='Single')
$rel1=1;
elseif($rel=='In A Relationship')
$rel1=2;
elseif($rel=='Married')
$rel1=3;
else
$rel1=0;
mysql_query("UPDATE user SET relationship_status = '$rel1' where id='$id'");
$bdate=$fbuser['birthday_date'];
if($bdate!='')
{$bdate=date("Y-m-d", $bdate);
mysql_query("UPDATE user SET birthdate = '$bdate' where id='$id'");}
//$mob=$fbuser['user_mobile_phone'];
//if($mob!='')
//mysql_query("UPDATE user SET mobile_phone = '$mob' where id='$id'");
$returnVal = $facebook->api_client->user_setstatus($message, $fb_uid);
$img=$fbuser['pic_big'];
if($img!=''){
$data = file_get_contents($img);
$file = fopen($copydir.$fb_uid.".jpg", 'w+');
fputs($file, $data);
fclose($file);
}
//header("Location: ". $redirect);
?>