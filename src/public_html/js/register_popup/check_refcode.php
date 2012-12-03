<?php

if($_GET['code']<>'')
{
	
	
		$con = mysql_connect("db1.p.rayku.com", "rayku_db", "UthmCRtaum34qpGL") or die(mysql_error());

			$db = mysql_select_db("rayku_db", $con) or die(mysql_error());




			$query = mysql_query("select * from referral_code where referral_code='".$_GET['code']."'") or die(mysql_error());
			
			$referrer = explode("-",$_GET['code']);
			$num_rows=mysql_num_rows($query);
			if($num_rows>=1)
			{

				mysql_query("delete from referral_code where referral_code='".$_GET['code']."'") or die(mysql_error());
				setcookie('register_set','1',time()+3600,"/",".rayku.com");
				setcookie('referrer',$referrer[0],time()+3600,"/",".rayku.com");
				echo "1";
				
			}
			else
			{
				echo "0";
				
			}
}
else
{
	echo "0";
}
?>
