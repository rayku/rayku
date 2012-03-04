<?php 
$connection = RaykuCommon::getDatabaseConnection();
if($_POST['status']=='1')
{
	$sel_misqry = mysql_query("SELECT * FROM popup_close WHERE user_id ='".$_POST['userid']."'", $connection);
	$misqry = mysql_fetch_array($sel_misqry);
	if($misqry['userid']!="")
	{
		 mysql_query("INSERT INTO `popup_close` (
		 `id` ,
		 `user_id`
		 )
		 VALUES (
		 NULL , '".$_POST['userid']."' ", $connection);
	}

}
else if($_POST['status']=='2')
{
  $sel_misqry = mysql_query("DELETE FROM popup_close WHERE user_id='".$_POST['userid']."'", $connection);
}


 ?>

