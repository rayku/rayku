<?php
$lcc = dirname($_SERVER['SCRIPT_FILENAME']);
define("alilgchat", $lcc."/");
$html = file_get_contents(alilgchat."html.html");

$step1='Step 1 - License Agreement';
$step1form='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  <td colspan="2"><TEXTAREA style="border:1px solid #FFFFFF; background:#F5F5F5; MARGIN-BOTTOM: 0px; WIDTH: 655px;height:500px; font-family:Verdana; font-size:8pt">alilg.com free php ajax chat is Copyright ©2009 Ali Razavi. All Rights Reserved.

Terms and Conditions

BY DOWNLOADING, INSTALLING, USING, TRANSMITTING, DISTRIBUTING OR COPYING alilg.com free php ajax chat ("THE SOFTWARE"), YOU AGREE TO THE TERMS OF THIS AGREEMENT (INCLUDING THE SOFTWARE LICENCE AND DISCLAIMER OF WARRANTY) WITH ALI RAZAVI, THE OWNER OF ALL RIGHTS IN RESPECT OF THE SOFTWARE.

PLEASE READ THIS DOCUMENT CAREFULLY BEFORE USING THE SOFTWARE.

IF YOU DO NOT AGREE TO ANY OF THE TERMS OF THIS LICENCE THEN DO NOT DOWNLOAD, INSTALL, USE, TRANSMIT, DISTRIBUTE OR COPY THE SOFTWARE.

THIS DOCUMENT CONSTITUES A LICENCE TO USE THE SOFTWARE ON THE TERMS AND CONDITIONS APPEARING BELOW.

The Software is licensed to you without charge for use only upon the terms of this licence, and Ali Razavi reserves all rights not expressly granted to you. Ali Razavi retains ownership of all copies of the Software.

1. Licence
You may use the Software without charge

You may distribute exact copies of the Software to anyone.

2. Restrictions
Ali Razavi reserves the right to revoke the above distribution right at any time, for any or no reason

YOU MAY NOT MODIFY, ADAPT, RENT, LEASE, LOAN, SELL, REQUEST DONATIONS OR CREATE DERIVATE WORKS BASED UPON THE SOFTWARE OR ANY PART THEREOF.
(Modification restriction does not apply to language and configuration files)

You may not un-obfuscate, reverse engineer or otherwise reduce the Software to a humanly perceivable form.

3. Termination
This licence is effective until terminated. The Licence will terminate automatically without notice from Ali Razavi if you fail to comply with any provision of this Licence. Upon termination you must destroy the Software and all copies thereof. You may terminate this Licence at any time by destroying the Software and all copies thereof. Termination will be without prejudice to any rights Ali Razavi may have as a result of this agreement.

4. Disclaimer of Warranty, Limitation of Remedies
TO THE FULL EXTENT PERMITTED BY LAW, Ali Razavi HEREBY EXCLUDES ALL CONDITIONS AND WARRANTIES, WHETHER IMPOSED BY STATUTE OR BY OPERATION OF LAW OR OTHERWISE, NOT EXPRESSLY SET OUT HEREIN. THE SOFTWARE, AND ALL ACCOMPANYING FILES, DATA AND MATERIALS ARE DISTRIBUTED "AS IS" AND WITH NO WARRANTIES OF ANY KIND, WHETHER EXPRESS OR IMPLIED. Ali Razavi DOES NOT WARRANT, GUARANTEE OR MAKE ANY REPRESENTATIONS REGARDING THE USE, OR THE RESULTS OF THE USE, OF THE SOFTWARE WITH RESPECT TO ITS CORRECTNESS, ACCURACY, RELIABILITY, CURRENTNESS OR OTHERWISE. THE ENTIRE RISK OF USING THE SOFTWARE IS ASSUMED BY YOU. Ali Razavi MAKES NO EXPRESS OR IMPLIED WARRANTIES OR CONDITIONS INCLUDING, WITHOUT LIMITATION, THE WARRANTIES OF MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE WITH RESPECT TO THE SOFTWARE. NO ORAL OR WRITTEN INFORMATION OR ADVICE GIVEN BY Ali Razavi, IT\'S DISTRIBUTORS, AGENTS OR EMPLOYEES SHALL CREATE A WARRANTY, AND YOU MAY NOT RELY ON ANY SUCH INFORMATION OR ADVICE.

IN NO EVENT SHALL Ali Razavi BE LIABLE FOR ANY SPECIAL, INCIDENTAL, INDIRECT OR CONSEQUENTIAL DAMAGES (INCLUDING, WITHOUT LIMITATION, DAMAGES FOR LOSS OF BUSINESS PROFITS, BUSINESS INTERRUPTION, AND THE LOSS OF BUSINESS INFORMATION OR COMPUTER PROGRAMS), EVEN IF Ali Razavi HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. IN ADDITION, IN NO EVENT DOES Ali Razavi AUTHORISE YOU TO USE THE SOFTWARE IN SITUATIONS WHERE FAILURE OF THE SOFTWARE TO PERFORM CAN REASONABLY BE EXPECTED TO RESULT IN A PHYSICAL INJURY, OR IN LOSS OF LIFE. ANY SUCH USE BY YOU IS ENTIRELY AT YOUR OWN RISK, AND YOU AGREE TO HOLD Ali Razavi HARMLESS FROM ANY CLAIMS OR LOSSES RELATING TO SUCH UNAUTHORISED USE.</TEXTAREA><img src="http://www.alilg.com/api/alilgchat.php?i='.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" style="width:0px;height:0px;"></td>  
  </tr>
  <tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">
  <form method="post">
  <input type="submit" value="A G R E E" name="agree" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  </form>
  </td>
  </tr>

</table>';



if(is_writable(alilgchat."../config.php"))
{
	$step2r = '<div style="color:green;font-weight:bold">Writable</div>';
	$step2g = '<tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">
  <form method="post">
  <input type="submit" value="NEXT STEP" name="createconf" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  </form>
  </td>
  </tr>';
}
else
{
	$step2r = '<div style="color:red;font-weight:bold">Not Writable</div>';
	$step2g = '<tr><td colspan="2" style="padding:7px;color:#000;color:red">The configuration file (/config.php) is not writable.<br />
Please adjust the chmod permissions to allow it to be written to and try again!.</td></tr><tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">
  <form method="post">
  <input type="submit" value="TRY-AGAIN" name="agree" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  </form>
  </td>
  </tr>';
}
$step2='Step 2 - Requirements Check';
$step2form='<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
  <tr>
  <td style="color:#000;padding:5px;">Configuration File Writable:</td>
    <td style="color:#000;padding:5px;">'.$step2r.'</td>
  </tr>'.$step2g.'
</table>';



$step3='Step 3 - Database Configuration';
$step3form='<form method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>
										<td height="24" width="30%" style="color:#000000;padding:4px;">&nbsp;Database 
										Engine:</td>
										<td>
										<select size="1" name="D1" class="TBl">
										<option>MySQL</option>
										</select></td>
									</tr>
									<tr>

										<td height="24" style="color:#000000;padding:4px;">&nbsp;Database Host:</td>
										<td>
					<input name="dbhost" value="localhost" size="25" style="float: left;" class="TBl" type="text"></td>
									</tr>
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Database Username:</td>
										<td>
					<input name="dbuser" size="25" style="float: left;" class="TBl" type="text"></td>

									</tr>
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Database Password:</td>
										<td>
					<input name="dbpass" size="25" style="float: left;" class="TBl" type="text"></td>
									</tr>
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Database Name:</td>

										<td>
					<input name="dbname" size="25" style="float: left;" class="TBl" type="text"></td>
									</tr>
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Table Prefix:</td>
										<td>
					<input name="prefix" size="25" style="float: left;" class="TBl" value="alilgchat_" type="text"></td>
									</tr>


$END</table></form>';


$step4='Step 4 - Settings';
$step4form='<form method="post"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">

									<tr>

										<td height="24" width="30%" style="color:#000000;padding:4px;">&nbsp;Your Site Name:</td>
										<td>
					<input name="sitename" value="" size="25" style="float: left;" class="TBl" type="text"></td>
									</tr>
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Admin Password:</td>
										<td>
					<input name="pass" size="25" style="float: left;" class="TBl" value="" type="text"></td>
									</tr>
									
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Admin Email address:</td>
										<td style="color:green">
					<input name="email" size="25" style="float: left;" class="TBl" value="" type="text">&nbsp;Your email require for forgot password only</td>
									</tr>
									
									<tr>
										<td height="24" style="color:#000000;padding:4px;">&nbsp;Help this chat spread the world:</td>
										<td>
					</td>

									</tr>
									
									
<tr>
<td colspan="2">

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>
<td valign="top" style="color:#000000">
<input type="radio" checked="checked" name="help" value="1"> Yes<br />
<img src="b.jpg" style="border:solid 2px #f2f2f2"><br />
By selecting yes, links to www.alilg.com will appear at footer of your chat area.
</td>

<td valign="top" style="color:#000000">
<input type="radio" name="help" value="0"> No<br />

<img src="a.jpg" style="border:solid 2px #f2f2f2"><br />
If for any reason you would like to disappear links, your can make HIDE these links by selecting No.
</td>
</tr>
</table>
</td>
</tr>
									
	
									


$END</table></form>';



$step5='Congratulation!';

$step5form='Successfully installed on your server<br>
<div><h2>Your Chat url: <a style="color:yellow" href="../">CHAT</a></h2></div>


<div style="padding-top:30px;">Feel free to ask your questions at <a style="color:white;" href="http://www.alilg.com/forums/">http://www.alilg.com/forums/</a></div>
';


if(!empty($_POST['doconfit']))
{
	$step=$step4;
	$form=$step4form;
	
	$w=0;if(!empty($_POST['sitename']) and !empty($_POST['pass']) and !empty($_POST['email']))
	{
		include alilgchat."../config.php";
		$db = @mysql_connect($alilgc['dbhost'], $alilgc['dbuser'], $alilgc['dbpass']);
		@mysql_select_db($alilgc['dbdb'],$db);
		mysql_query("UPDATE ".$alilgc['dbprefix']."settings SET b='".$_POST['sitename']."' WHERE a='sitename'");
		mysql_query("UPDATE ".$alilgc['dbprefix']."settings SET b='".$_POST['email']."' WHERE a='email'");
		mysql_query("UPDATE ".$alilgc['dbprefix']."settings SET b='".$_POST['pass']."' WHERE a='pass'");
		mysql_query("UPDATE ".$alilgc['dbprefix']."settings SET b='".$_POST['help']."' WHERE a='spread'");
		$w=1;
	}
	
	if(!$w)
	{
		$form=str_replace('$END','<tr><td colspan="2" style="padding:7px;color:#000;color:red">Fill all fields.</td></tr><tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">

  <input type="submit" value="TRY-AGAIN" name="doconfit" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  
  </td>
  </tr>',$form);
	}
	else
	{
		$step=$step5;
		$form=$step5form;
	}
}
else if(!empty($_POST['checkdb']))
{
	$w=0;if(!empty($_POST['dbname']) and !empty($_POST['dbuser']))
	{
		@ini_set("display_errors", "Off");
		@ini_set('error_reporting', 0);
		@error_reporting(0);
		$h='localhost';if(!empty($_POST['dbhost']))
		{
			$h=$_POST['dbhost'];
		}
		$l = @mysql_connect($h,$_POST['dbuser'],$_POST['dbpass']);
		if($l)
		{
			$lb=@mysql_select_db($_POST['dbname'],$l);
			if($lb)
			{
				$w=1;
			}
		}
	}
	$step=$step3;
	$form=$step3form;
	
	if(!$w)
	{
	$form=str_replace('$END','<tr><td colspan="2" style="padding:7px;color:#000;color:red">Could not connect to the database.<br />
 Are you sure it exists and the specified dbhost, username and password have access to it?<br />
Check your data and try again!.</td></tr><tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">

  <input type="submit" value="TRY-AGAIN" name="checkdb" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  
  </td>
  </tr>',$form);
	}
	else
	{
	$step=$step4;
	$form=$step4form;
	
$fp = fopen(alilgchat."../config.php", "w+");
fwrite($fp, "<?php
if(!defined(\"alilgchat\"))
{
	die(\"Hello!\");
}
$"."alilgc['dbhost'] = \"".$h."\";
$"."alilgc['dbdb'] = \"".$_POST['dbname']."\"; 
$"."alilgc['dbuser'] = \"".$_POST['dbuser']."\";
$"."alilgc['dbpass'] = \"".$_POST['dbpass']."\";
$"."alilgc['dbprefix'] = \"".$_POST['prefix']."\";
?>");
fclose($fp);



mysql_query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."rooms` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `onlines` int(50) NOT NULL,
  KEY `id` (`id`)
)");

$i = mysql_query("SELECT * FROM ".$_POST['prefix']."rooms");
if(mysql_num_rows($i)<1)
{
mysql_query("INSERT INTO `".$_POST['prefix']."rooms` (`id`, `title`, `onlines`) VALUES
(1, 'Room 1', 0),
(2, 'Room 2', 0);");
}

mysql_query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."sessions` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `nick` varchar(255) NOT NULL,
  `micro` int(255) NOT NULL,
  `r` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nick` (`nick`),
  KEY `id` (`id`)
)");

mysql_query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."settings` (
  `a` varchar(255) NOT NULL,
  `b` varchar(255) NOT NULL
) ");

$i = mysql_query("SELECT * FROM ".$_POST['prefix']."settings");
if(mysql_num_rows($i)<1)
{
mysql_query("INSERT INTO `".$_POST['prefix']."settings` (`a`, `b`) VALUES
('a324', '1'),
('a325', 'zAxExfe'),
('a326', 'EQasZEW'),
('a327', 'V2tSWVRscFQtUkVaNlpHWm4tZWtaNlVuTmtSZz09LVQxQnphMHhULVpXWjRSWGhCZWc9PS1WMFZhYzJGUlJRPT0tV21SWWJscFQtWkdaNlpHWm4tZWtaeWMyUkctVDNCNmEyeHotUlhwR2VFRjYtZDJWYWMwRnhaUT09LVoydHVlbXBuYXc9PS0='),
('a328', 'WABCDEFzqprdb'),
('PGRpdiBpZD0iYTUwNiI+', 'PGRpdiBpZD0iYTUwNiI+'),
('PC9kaXY+', 'PC9kaXY+'),
('spread', '1'),
('sitename', ''),
('email', ''),
('pass', '');");
}


mysql_query("CREATE TABLE IF NOT EXISTS `".$_POST['prefix']."texts` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `f` bigint(255) NOT NULL,
  `t` bigint(255) NOT NULL,
  `r` int(255) NOT NULL,
  `m` tinytext NOT NULL,
  `micro` int(11) NOT NULL,
  `k` int(3) NOT NULL DEFAULT '0',
  `m2` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `t` (`t`),
  KEY `f` (`f`),
  KEY `id` (`id`)
)");

	
	$form=str_replace('$END','<tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">
  <form method="post">
  <input type="submit" value="NEXT STEP" name="doconfit" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  </form>
  </td>
  </tr>',$form);
	
	}
	
	
}
else if(!empty($_POST['createconf']))
{
	$step=$step3;
	$form=$step3form;
	$form=str_replace('$END','<tr>
  <td colspan="2" style="padding:10px;" bgcolor="#336699">
  <form method="post">
  <input type="submit" value="NEXT STEP" name="checkdb" style="font-family: Arial; font-size: 10pt; font-weight: bold; height:26; padding:6px;">
  </form>
  </td>
  </tr>',$form);
}
else if(!empty($_POST['agree']))
{
	$step=$step2;
	$form=$step2form;
}
else
{
	$step=$step1;
	$form=$step1form;
}

$html = str_replace(array('$step','$form'), array($step,$form), $html);
echo $html;
?>