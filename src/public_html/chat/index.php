<?php
session_start();
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

$lcc = dirname($_SERVER['SCRIPT_FILENAME']);
define("alilgchat", $lcc."/");

$alilgc = array();
error_reporting(E_ALL ^ E_NOTICE);
include alilgchat."config.php";

foreach ($_POST as $key => $value) {
    $_POST['$key'] = @mysql_real_escape_string($value);
  }

  foreach ($_GET as $key => $value) {
    $_GET['$key'] = @mysql_real_escape_string($value);
  }
  
  foreach ($_POST as $key => $value) {
    $_POST['$key'] = strip_tags($value);
  }

  foreach ($_GET as $key => $value) {
    $_GET['$key'] = strip_tags($value);
  }
class alilgchat
{
	var $db;
	var $dpr;
	var $a635;
	var $a457;
	var $aGX;
	var $idle;
	var $acv;
	var $bvc;
	
	function f309($c103)
	{
		return $this->f711($c103);
		return ereg_replace("[^A-Za-z0-9 -]", "", $c103);
	}
	function f711($l)
	{
		$l = ereg_replace("\n|\r|\r\n|\n\r", "", $l);
		$a = array('','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','/','*','+','~','`','=');
		$l = str_replace($a, '', $l);
		return $l;
	}
	function alilgchat()
	{
		$this->bvc = array();
		$this->dbact(1);
		$this->aGX = time();
		$this->idle = 0.25;
		if(!empty($_POST['m523']))
		{
			die($this->f702($_POST['m523']));
		}
		else if(!empty($_GET['a456']))
		{
			die($this->f536());
		}
		else if(!empty($_GET['a457']) and !empty($_GET['a635']))
		{
			$this->a457=$_GET['a457'];
			$this->a635=$this->f309($_GET['a635']);
			die($this->f537());
		}
		else if(!empty($_GET['a458']))
		{
			die($this->f701($_GET['a458']));
		}
		else if(!empty($_GET['a903']))
		{
			$name = mysql_query("SELECT nick FROM ".$this->dpr."sessions WHERE id='".$_GET['a903']."'");
			$name = @mysql_fetch_array($name);
			$name = $name['nick'];
			if($_GET['a905']==$_GET['a903'])
			{
				$bn = '';
				$nn = '';
				$bb = '';
				$e14 = '';
			}
			else
			{
				$bn = '';
				$nn = '';
				$bb = '';
				$e14 = '';
			}
			//die($_GET['a903']);
			$h = '
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>'.$name.'</title>
<link href="style/pstyle.css" rel="stylesheet" type="text/css">
</head>
<body>
<script language="javascript" type="text/javascript">
function k333()
{
	opener.ln('.$_GET['a903'].')
}
window.onbeforeunload=k333;
var a30088 = '.$_GET['i2'].';
function a462(l)
{
	if(!opener)
	{
		window.close();
	}
	if(l)
	{
		eval(l);
	}
}
a462();
function a102()
{
	var a30800 = opener.document.getElementById(\'e206\').value;
	if(a30088!=a30800)
	{
		window.close();
		document.write("SESSION EXPRIED");
	}
}
</script>
<form method="post"><input type="hidden" name="e14" value="'.$e14.'"><input type="hidden" name="m501" id="m501" value="'.$_GET['a905'].'"><input type="hidden" name="m521" id="m521" value="'.$_GET['a904'].'"><input type="hidden" name="m531" id="m531" value="'.$_GET['a903'].'">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr><td height="4" valign="top"><img src="pix/floatup_two.png"></td></tr><tr><td background="pix/custom_one.png" valign="top"><table cellpadding="0" cellspacing="0" width="100%"><tbody><tr><td background="images/ATPM_03.png" width="11"><span style="float: left;"><img src="pix/pmbox_left_top.png"></span></td><td style="background-image: url(pix/pm_bg_repeat.png);width:310px;font-weight:bold;">'.$name.'</td><td width="16"><span style="float: right;"><img src="pix/pmbox_right_top.png" height="26" width="17"></span></td></tr></tbody></table><div align="center"><table cellpadding="0" width="367"><tbody><tr><td colspan="2"><div class="pmshowdiv" id="jain_1" style="overflow: auto;"><div id="a236" style="padding: 4px;" unselectable="on">'.$nn.'</div></div></td></tr><tr><td colspan="2"></td></tr><tr><td><textarea rows="3" onkeyup="opener.jusc(event,1,'.$_GET['a903'].')" name="m523" id="a215" cols="53" class="TBOX" '.$bb.' style="width: 296px; height: 40px;">'.$nn.'</textarea></td><td><div align="left"><table cellpadding="0" cellspacing="0" width="90%"><tbody><tr><td width="8"><img src="pix/big_send_left_provide.png"></td><td><input type="button" onclick="opener.jusc2(1,'.$_GET['a903'].')" '.$bb.' id="simone" style="border-style: solid; border-width: 0pt; padding: 0pt; height: 40px; width: 45px; font-family: Arial; font-size: 8pt; background-image: url(pix/big_send_center_provide.png);" value="Send"></td><td width="8"><img src="pix/big_send_right_provide.png"></td></tr></tbody></table></div></td></tr><tr><td colspan="2" class="NinjaTyping" height="18"></td></tr></tbody></table></div></td></tr><tr><td height="4" valign="top"><img src="pix/floatup.png" height="4" width="385"></td></tr>
</table>
</form>
<script language="javascript" type="text/javascript">
a102();
a462();
'.$bn.'
setInterval("a102();",2000);
</script>
</body>
</html>';
die($h);
		}
		
	}
	function f907()
	{
		$this->acv['a327'] = explode("-",$this->a607($this->acv['a327']));
	}
	function f702($l)
	{
		$a34=0;
		if(!empty($_POST['m531']))
		{
			$a34=$_POST['m531'];
		}$m2='';
		if(!empty($_POST['m2']))
		{
			$m2=substr($_POST['m2'],1,strlen($_POST['m2']));
		}
		
		mysql_query("INSERT INTO ".$this->dpr."texts(f,t,r,m,micro,k,m2)values('".$_POST['m501']."','".$a34."','".$_POST['m521']."','".$l."','".time()."','0','".$m2."')");
		$j='';$cc = mysql_query("SELECT id,r FROM ".$this->dpr."sessions WHERE r='".$_POST['m521']."' AND micro<'".(time() - (60*$this->idle))."'");
		$ls = array();
		if(mysql_num_rows($cc)>0)
		{
			while($co=mysql_fetch_array($cc))
			{				
				array_push($ls, $co['id']);
				mysql_query("DELETE FROM ".$this->dpr."sessions WHERE id='".$co['id']."'");
			}
		}
		for($p=0;$p<count($ls);$p++)
		{
		$cc = mysql_query("SELECT id,r FROM ".$this->dpr."sessions WHERE r='".$_POST['m521']."'");
		if(mysql_num_rows($cc)>0)
		{
		while($co=mysql_fetch_array($cc))
		{
			mysql_query("INSERT INTO ".$this->dpr."texts(f,t,r,m,micro,k)values('".$ls[$p]."','".$co['id']."','".$co['r']."','','".time()."','2')");
		}
		}
		}
	}
	function signal()
	{
		$cc = mysql_query("SELECT id,r FROM ".$this->dpr."sessions WHERE micro<'".(time() - (60*$this->idle))."'");
		$ls = array();
		if(mysql_num_rows($cc)>0)
		{
			while($co=mysql_fetch_array($cc))
			{				
				array_push($ls, array($co['id'], $co['r']));
				mysql_query("DELETE FROM ".$this->dpr."sessions WHERE id='".$co['id']."'");
			}
		}
		
		for($p=0;$p<count($ls);$p++)
		{
		$cc = mysql_query("SELECT id,r FROM ".$this->dpr."sessions WHERE r='".$ls[$p][1]."'");
		if(mysql_num_rows($cc)>0)
		{
		while($co=mysql_fetch_array($cc))
		{
			mysql_query("INSERT INTO ".$this->dpr."texts(f,t,r,m,micro,k)values('".$ls[$p][0]."','".$co['id']."','".$co['r']."','','".time()."','2')");
		}
		}
		}
	}
	function f701($l)
	{
		mysql_query("UPDATE ".$this->dpr."sessions SET micro='".time()."' WHERE id='".$_GET['v237']."'");
		$q='';$q2='';$q3='';
		if($_GET['j']==-1)
		{
			$TMBACK = (time()-(60*60));
		$s = $this->query("SELECT * FROM ".$this->dpr."texts WHERE micro>'".$TMBACK."' AND r='".$l."' AND t='".$_GET['v237']."' OR micro>'".$TMBACK."' AND r='".$l."' AND t='0'");
		}
		else
		{
		$s = $this->query("SELECT * FROM ".$this->dpr."texts WHERE id>".$_GET['j']." AND r='".$l."' AND t='".$_GET['v237']."' OR id>".$_GET['j']." AND r='".$l."' AND t='0'");
		}
		$p=1;$p2=1;
		if(mysql_num_rows($s)<1)
		{			
		return 'var s60=Array();var s61=Array();var s62=Array();';
		}
		else
		{
		while($pl=mysql_fetch_array($s))
		{
			if($pl['k']=='1' and $pl['t']==$_GET['v237'])
			{
			$co = mysql_query("SELECT id,nick FROM ".$this->dpr."sessions WHERE id='".$pl['f']."'");
			if(mysql_num_rows($co)>0)
			{
			$co = mysql_fetch_array($co);
			$q2.='Array('.$co['id'].', \''.$co['nick'].'\'),';
			}
			$xl=$pl['id'];
			}
			else if($pl['k']=='2' and $pl['t']==$_GET['v237'])
			{
			$q3.='Array('.$pl['f'].',1),';
			$xl=$pl['id'];
			}
			else if($pl['k']=='0')
			{
			$p++;$q.='Array('.$pl['f'].', \''.$this->f309($pl['m']).'\', '.$pl['t'].', \''.$pl['m2'].'\'),';
			$xl=$pl['id'];
			}
		}
		return 'var v200='.$xl.';var s60=Array('.substr($q, 0, strlen($q)-1).');var s61=Array('.substr($q2, 0, strlen($q2)-1).');var s62=Array('.substr($q3, 0, strlen($q3)-1).');';
		}
	}
	function f537()
	{
		$co = mysql_query("SELECT nick FROM ".$this->dpr."sessions WHERE nick='".$this->a635."'");
		$lp = time() + rand(1, 1000000);
		if(mysql_num_rows($co)<1)
		{
			$ck = $this->a635;
		}
		else
		{
			$ck = $this->a635;
			$ckx=$ck;
			$pr=1;
			$co = mysql_query("SELECT nick FROM ".$this->dpr."sessions WHERE nick='".$ck."'");
			while(mysql_num_rows($co)>0)
			{
				$ck =$ckx.$pr;
				$pr++;
				$co = mysql_query("SELECT nick FROM ".$this->dpr."sessions WHERE nick='".$ck."'");
			}			
		}
		mysql_query("INSERT INTO ".$this->dpr."sessions(nick,micro,r)values('".$ck."','".time()."','".$this->a457."')");
		$idL = mysql_query("SELECT id FROM ".$this->dpr."sessions WHERE nick='".$ck."' ORDER BY id DESC LIMIT 1");
		$idL = mysql_fetch_array($idL);
		$idL = $idL['id'];
		$this->signal();
		$q='';$s = $this->query("SELECT * FROM ".$this->dpr."sessions WHERE r='".$this->a457."'");$p=1;
		while($pl=mysql_fetch_array($s))
		{
			if($pl['id']!=$idL)
			{
			mysql_query("INSERT INTO ".$this->dpr."texts(f,t,r,m,micro,k)values('".$idL."','".$pl['id']."','".$pl['r']."','','".time()."','1')");
			}
			$p++;$q.='Array('.$pl['id'].', \''.$pl['nick'].'\')';
			if(($p-1)<mysql_num_rows($s))
			$q.=',';
		}
		
		$lt = mysql_query("SELECT id FROM ".$this->dpr."texts ORDER BY id DESC LIMIT 1");
		if(mysql_num_rows($lt)>0)
		{
		$lt = mysql_fetch_array($lt);
		$lt = $lt['id'];
		}
		else
		{
			$lt=0;
		}
		return 'x236.v237='.$idL.';x236.v236=\''.$ck.'\';var v200=-1;var s59=Array('.$this->a348().');var s60=Array('.$q.');';
	}
	function a348()
	{
		return $this->a206(array(array('PHRhZ2tuempna2xlIHdpd2Vac0FxZXRoPSI2MTAiIGdrbnpqZ2tvRXpGeEF6d2Vac0FxZWVFekZ4QXo9IjAiIGNlbGxz'), array('T3B6a2xzYWNpbmc9IjAiIGNlbGxPcHprbHNhd2Vac0FxZXdlWnNBcWVpbmc9IjAiPiAgPHRFekZ4QXo+ICA='), array('PHR3ZVpzQXFlIGNvbHNPcHprbHNhbj0iMiI+ICA8d2Vac0FxZWl2IHN0eWxlPSJ3aXdlWnNBcWV0aA=='), array('OmF1dG87aGVpZ2h0OjZPcHprbHN4OyI+PC93ZVpzQXFlaXY+ICA8L3R3ZVpzQXFlPiAgPA=='), array('L3RFekZ4QXo+ICA8dEV6RnhBej4gICAgPHR3ZVpzQXFlIHdpd2Vac0FxZXRoPSI0NTAiPiAgICA8'), array('d2Vac0FxZWl2IGl3ZVpzQXFlPSJhMjE3IiBzdHlsZT0iaGVpZ2h0OjM3Nk9wemtsc3g7dw=='), array('aXdlWnNBcWV0aDo0NTBPcHprbHN4O2drbnpqZ2tvRXpGeEF6d2Vac0FxZWVFekZ4QXo6c29saXdlWnNBcWUgMU9wemtsc3ggIzhlYWZ3ZVpzQXFld2Vac0FxZQ=='), array('O2drbnpqZ2thY2tnRXpGeEF6b3Vud2Vac0FxZS1jb2xvRXpGeEF6OndoaXRlO21hRXpGeEF6Z2luLUV6RnhBemlnaA=='), array('dDoxME9wemtsc3g7b3ZlRXpGeEF6ZmxvdzphdXRvIj4gICAgICAgIDx3ZVpzQXFlaXYg'), array('c3R5bGU9Ik9wemtsc2F3ZVpzQXFld2Vac0FxZWluZzo1T3B6a2xzeDsiIGl3ZVpzQXFlPSJhMjE2Ij4gICAg'), array('ICAgIDwvd2Vac0FxZWl2PiAgICA8L3dlWnNBcWVpdj4gICAgPC90d2Vac0FxZT4gICAgPHQ='), array('d2Vac0FxZSB3aXdlWnNBcWV0aD0iMTYwIj4gICAgPHdlWnNBcWVpdiBzdHlsZT0iZ2tuempna2Fja2c='), array('RXpGeEF6b3Vud2Vac0FxZS1pbWFnZTp1RXpGeEF6bCgnaW1nL09wemtsc2hPcHprbHMtYWpheC1jaGF0LQ=='), array('bG9na256amdrZ2tuempna3lfMDkuZ2lmJyk7d2l3ZVpzQXFldGg6MTU5T3B6a2xzeDtoZWlnaHQ6MQ=='), array('M09wemtsc3g7Ij48L3dlWnNBcWVpdj4gICAgPHdlWnNBcWVpdiBzdHlsZT0id2l3ZVpzQXFldGg6MQ=='), array('NTdPcHprbHN4O2drbnpqZ2tvRXpGeEF6d2Vac0FxZWVFekZ4QXotbGVmdDpzb2xpd2Vac0FxZSAxT3B6a2xzeCAjOGVhZndlWnNBcWV3ZVpzQXFlOw=='), array('Z2tuempna29FekZ4QXp3ZVpzQXFlZUV6RnhBei1FekZ4QXppZ2h0OnNvbGl3ZVpzQXFlIDFPcHprbHN4ICM4ZWFmd2Vac0FxZXdlWnNBcWUiPiAgIA=='), array('IDx3ZVpzQXFlaXYgc3R5bGU9ImhlaWdodDozMjlPcHprbHN4O2drbnpqZ2thY2tnRXpGeEF6b3Vu'), array('d2Vac0FxZS1jb2xvRXpGeEF6OndoaXRlO292ZUV6RnhBemZsb3c6YXV0byI+ICAgIDx3ZVpzQXFl'), array('aXYgc3R5bGU9Ik9wemtsc2F3ZVpzQXFld2Vac0FxZWluZzo1T3B6a2xzeDsiIGl3ZVpzQXFlPSJhMzMyIj4g'), array('ICAgPC93ZVpzQXFlaXY+ICAgIDwvd2Vac0FxZWl2PiAgICA8L3dlWnNBcWVpdj4gICAgPHdlWnNBcWU='), array('aXYgc3R5bGU9ImdrbnpqZ2thY2tnRXpGeEF6b3Vud2Vac0FxZS1pbWFnZTp1RXpGeEF6bCgnaW1n'), array('L09wemtsc2hPcHprbHMtYWpheC1jaGF0LWxvZ2tuempna2drbnpqZ2t5XzEyLmdpZicpO3dpd2Vac0FxZXRo'), array('OjE1OU9wemtsc3g7aGVpZ2h0OjM2T3B6a2xzeDsiPjwvd2Vac0FxZWl2PiAgICA8L3R3ZVpzQXFl'), array('PiAgPC90RXpGeEF6PiAgPHRFekZ4QXo+ICA8dHdlWnNBcWUgY29sc09wemtsc2FuPSIyIj4gIDw='), array('dGFna256amdrbGUgd2l3ZVpzQXFldGg9IjUyMCIgZ2tuempna29FekZ4QXp3ZVpzQXFlZUV6RnhBej0iMCIgY2VsbHNPcHprbHM='), array('YWNpbmc9IjAiIGNlbGxPcHprbHNhd2Vac0FxZXdlWnNBcWVpbmc9IjAiPiAgPHRFekZ4QXo+ICA8'), array('dHdlWnNBcWUgY29sc09wemtsc2FuPSIyIj48dGFna256amdrbGUgZ2tuempna29FekZ4QXp3ZVpzQXFlZUV6RnhBej0iMCIgY2U='), array('bGxPcHprbHNhd2Vac0FxZXdlWnNBcWVpbmc9IjAiIGNlbGxzT3B6a2xzYWNpbmc9IjAiIHdpd2Vac0FxZXRo'), array('PSIxMDAlIiBzdHlsZT0ibWFFekZ4QXpnaW4tdG9PcHprbHM6NE9wemtsc3g7Ij48dEV6RnhBeg=='), array('Pjx0d2Vac0FxZSB3aXdlWnNBcWV0aD0iMjEiPjx3ZVpzQXFlaXYgaXdlWnNBcWU9InNtaCI+PC93ZVpzQXFlaXY='), array('PjxpbWcgc3R5bGU9Im1hRXpGeEF6Z2luLXRvT3B6a2xzOjNPcHprbHN4OyIgaXdlWnNBcWU9InM='), array('bWhpIiBvbmNsaWNrPSJhc211T3B6a2xzKGV2ZW50KSIgc0V6RnhBemM9Ik9wemtsc2k='), array('eC9jaG9vc2Vfc21pbGV5LmdpZiI+PC90d2Vac0FxZT48dHdlWnNBcWUgd2l3ZVpzQXFldGg='), array('PSIyMSI+PHdlWnNBcWVpdiBpd2Vac0FxZT0ic21pbGl3ZVpzQXFlZnp3ZVpzQXFlZmciPjwvd2Vac0FxZWl2PjxpbWcgcw=='), array('dHlsZT0ibWFFekZ4QXpnaW4tdG9PcHprbHM6M09wemtsc3g7IiBvbmNsaWNrPSJjY3dlWnNBcWU='), array('aXNhZ2tuempna2xld2Vac0FxZSgpIiBzRXpGeEF6Yz0iT3B6a2xzaXgvY2hvb3NlX2NvbG9FekZ4QXouZ2k='), array('ZiI+PC90d2Vac0FxZT48dHdlWnNBcWUgd2l3ZVpzQXFldGg9IjEwNiI+PHdlWnNBcWVpdiBpd2Vac0FxZT0iZm8='), array('bnR3ZVpzQXFlZnp3ZVpzQXFlZmciPjwvd2Vac0FxZWl2Pjx0YWdrbnpqZ2tsZSBna256amdrb0V6RnhBendlWnNBcWVlRXpGeEF6PSIwIiBjZWxsT3B6a2xzYQ=='), array('d2Vac0FxZXdlWnNBcWVpbmc9IjAiIGNlbGxzT3B6a2xzYWNpbmc9IjAiIHdpd2Vac0FxZXRoPSIxMA=='), array('MiI+PHRFekZ4QXo+PHR3ZVpzQXFlIG9uY2xpY2s9Im9PcHprbHNlbmZvbmVFekZ4QXooKSIgc3Q='), array('eWxlPSJPcHprbHNhd2Vac0FxZXdlWnNBcWVpbmc6IDNPcHprbHN4OyIgY2xhc3M9ImZvbnRfaW50'), array('ZUV6RnhBemZhY2UiIGdrbnpqZ2thY2tnRXpGeEF6b3Vud2Vac0FxZT0iT3B6a2xzaXgvd2Vac0FxZUV6RnhBem9PcHprbHNfZ2tuempna2Fja2dFekZ4QXo='), array('b3Vud2Vac0FxZS5naWYiIHdpd2Vac0FxZXRoPSI4NSI+PE9wemtscyBzdHlsZT0iY3VFekZ4QXpz'), array('b0V6RnhBejogd2Vac0FxZWVmYXVsdDsiIHVuc2VsZWN0YWdrbnpqZ2tsZT0ib24iIGl3ZVpzQXFlPQ=='), array('ImZvbnRmYWNlIj5WZUV6RnhBendlWnNBcWVhbmE8L09wemtscz48L3R3ZVpzQXFlPjx0d2Vac0FxZT48aW1n'), array('IG9uY2xpY2s9Im9PcHprbHNlbmZvbmVFekZ4QXooKSIgc0V6RnhBemM9Ik9wemtsc2l4L3dlWnNBcWVFekZ4QXpv'), array('T3B6a2xzX3dlWnNBcWVvd24uZ2lmIiBna256amdrb0V6RnhBendlWnNBcWVlRXpGeEF6PSIwIiBoZWlnaHQ9IjIyT3B6a2xzeA=='), array('IiBzdHlsZT0iZmxvYXQ6bGVmdCIgd2l3ZVpzQXFldGg9IjE3T3B6a2xzeCI+PA=='), array('L3R3ZVpzQXFlPjwvdEV6RnhBej48L3RhZ2tuempna2xlPjwvdHdlWnNBcWU+PHR3ZVpzQXFlIHdpd2Vac0FxZXRoPSI0NA=='), array('Ij48d2Vac0FxZWl2IGl3ZVpzQXFlPSJzaXdlWnNBcWVmendlWnNBcWVmZ2V3ZVpzQXFlZnp3ZVpzQXFlZmciPjwvd2Vac0FxZWl2Pjx0YWdrbnpqZ2tsZSBna256amdrb0V6RnhBendlWnNBcWU='), array('ZUV6RnhBej0iMCIgY2VsbE9wemtsc2F3ZVpzQXFld2Vac0FxZWluZz0iMCIgY2VsbHNPcHprbHNhY2luZz0='), array('IjAiIHdpd2Vac0FxZXRoPSI0MCI+PHRFekZ4QXo+PHR3ZVpzQXFlIG9uY2xpY2s9Im9PcHprbHNl'), array('bnNpd2Vac0FxZWZ6d2Vac0FxZWZnZUV6RnhBeigpIiBzdHlsZT0iT3B6a2xzYXdlWnNBcWV3ZVpzQXFlaW5nOiAzT3B6a2xzeDsiIGNsYQ=='), array('c3M9ImZvbnRfaW50ZUV6RnhBemZhY2UiIGdrbnpqZ2thY2tnRXpGeEF6b3Vud2Vac0FxZT0iT3B6a2xzaXg='), array('L3NtYWxsX3dlWnNBcWVFekZ4QXpvT3B6a2xzX2drbnpqZ2tnLmdpZiIgd2l3ZVpzQXFldGg9IjIyIj48T3B6a2xzIHM='), array('dHlsZT0iY3VFekZ4QXpzb0V6RnhBejogd2Vac0FxZWVmYXVsdDsiIHVuc2VsZWN0YWdrbnpqZ2ts'), array('ZT0ib24iIGl3ZVpzQXFlPSJzaXdlWnNBcWVmendlWnNBcWVmZ2VmYWNlIj4mbmdrbnpqZ2tzT3B6a2xzOzg8L09wemtscz48L3Q='), array('d2Vac0FxZT48dHdlWnNBcWU+PGltZyBvbmNsaWNrPSJvT3B6a2xzZW5zaXdlWnNBcWVmendlWnNBcWVmZ2VFekZ4QXooKSIgc0V6RnhBeg=='), array('Yz0iT3B6a2xzaXgvZm9uZXRpYy5naWYiIGdrbnpqZ2tvRXpGeEF6d2Vac0FxZWVFekZ4QXo9IjAiIHN0eWw='), array('ZT0iZmxvYXQ6bGVmdCIgaGVpZ2h0PSIyMiIgd2l3ZVpzQXFldGg9IjE='), array('OCI+PC90d2Vac0FxZT48L3RFekZ4QXo+PC90YWdrbnpqZ2tsZT48L3R3ZVpzQXFlPjx0d2Vac0FxZSBoZWlnaA=='), array('dD0iMjgiIHZhbGlnbj0iZ2tuempna290dG9tIj48aW1nIGl3ZVpzQXFlPSJna256amdrb2w='), array('d2Vac0FxZU9wemtsc2ljIiBvbmNsaWNrPSJna256amdrb2x3ZVpzQXFldU9wemtscygpIiBzdHlsZT0iY3VFekZ4QXo='), array('c29FekZ4QXo6IE9wemtsc29pbnRlRXpGeEF6OyIgc0V6RnhBemM9Ik9wemtsc2l4L2V3ZVpzQXFlaXRvRXpGeEF6X2drbnpqZ2tvbHdlWnNBcWU='), array('X29mZi5naWYiPjxpbWcgaXdlWnNBcWU9Iml0YWxpY09wemtsc2ljIiBvbmNsaQ=='), array('Y2s9Iml0YWxpY3VPcHprbHMoKSIgc3R5bGU9ImN1RXpGeEF6c29FekZ4QXo6IE9wemtsc29pbg=='), array('dGVFekZ4QXo7IiBzRXpGeEF6Yz0iT3B6a2xzaXgvaXRhbGljX29mZi5naWYiPjxpbWc='), array('IGl3ZVpzQXFlPSJ1bndlWnNBcWVlRXpGeEF6bGluZU9wemtsc2ljIiBvbmNsaWNrPSJ1bndlWnNBcWVlRXpGeEF6bHU='), array('T3B6a2xzKCkiIHN0eWxlPSJjdUV6RnhBenNvRXpGeEF6OiBPcHprbHNvaW50ZUV6RnhBejsiIHNFekZ4QXpjPSI='), array('T3B6a2xzaXgvdW53ZVpzQXFlZUV6RnhBemxpbmVfb2ZmLmdpZiI+PC90d2Vac0FxZT48L3RFekZ4QXo+PC8='), array('dGFna256amdrbGU+ICA8L3R3ZVpzQXFlPiAgPC90RXpGeEF6PiAgPHRFekZ4QXo+ICA8dHdlWnNBcWU+PGZv'), array('RXpGeEF6bSBtZXRob3dlWnNBcWU9Ik9wemtsc29zdCI+PGluT3B6a2xzdXQgdHlPcHprbHNlPSJoaXdlWnNBcWV3ZVpzQXFlZQ=='), array('biIgbmFtZT0ibTIiIHZhbHVlPSIiPjxpbk9wemtsc3V0IHR5T3B6a2xzZT0i'), array('aGl3ZVpzQXFld2Vac0FxZWVuIiBuYW1lPSJtNTAxIiBpd2Vac0FxZT0ibTUwMSIgdmFsdWU='), array('PSIiPjxpbk9wemtsc3V0IHR5T3B6a2xzZT0iaGl3ZVpzQXFld2Vac0FxZWVuIiBuYW1lPSJtNTIx'), array('IiBpd2Vac0FxZT0ibTUyMSIgdmFsdWU9IiI+PHRleHRhRXpGeEF6ZWEgb25jbA=='), array('aWNrPSJ3ZVpzQXFld21uaCgpIiBuYW1lPSJtNTIzIiBpd2Vac0FxZT0ic2hpZ2tuempna2E='), array('Z2tuempna2EiIG9ua2V5dU9wemtscz0ianVzYyhldmVudCwyKSI+PC90ZXh0YQ=='), array('RXpGeEF6ZWE+PC9mb0V6RnhBem0+PC90d2Vac0FxZT4gIDx0d2Vac0FxZSBhbGlnbj0iRXpGeEF6aWdodCI='), array('IHdpd2Vac0FxZXRoPSIxMDAiIGhlaWdodD0iNDAiPiAgPHRhZ2tuempna2xlIGdrbnpqZ2s='), array('b0V6RnhBendlWnNBcWVlRXpGeEF6PSIwIiBjZWxsT3B6a2xzYXdlWnNBcWV3ZVpzQXFlaW5nPSIwIiBjZWxsc09wemtsc2FjaQ=='), array('bmc9IjAiIHdpd2Vac0FxZXRoPSIxMDAiPjx0RXpGeEF6Pjx0d2Vac0FxZSB3aXdlWnNBcWV0aD0iOA=='), array('IiBoZWlnaHQ9IjQwIiBna256amdrYWNrZ0V6RnhBem91bndlWnNBcWU9Ik9wemtsc2l4L2drbnpqZ2tpZ19z'), array('ZW53ZVpzQXFlX2xlZnRfT3B6a2xzRXpGeEF6b3Zpd2Vac0FxZWUuT3B6a2xzbmciPjwvdHdlWnNBcWU+PHR3ZVpzQXFlIHZhbGk='), array('Z249InRvT3B6a2xzIiBhbGlnbj0iY2VudGVFekZ4QXoiIHN0eWxlPSJ0ZXh0'), array('LWFsaWduOmNlbnRlRXpGeEF6O3ZlRXpGeEF6dGljYWwtYWxpZ246bWl3ZVpzQXFld2Vac0FxZWxl'), array('IiBna256amdrYWNrZ0V6RnhBem91bndlWnNBcWU9Ik9wemtsc2l4L2drbnpqZ2tpZ19zZW53ZVpzQXFlX2NlbnRlRXpGeEF6X09wemtscw=='), array('RXpGeEF6b3Zpd2Vac0FxZWUuT3B6a2xzbmciPjxpbk9wemtsc3V0IHR5T3B6a2xzZT0iZ2tuempna3V0dG9uIiBvbg=='), array('Y2xpY2s9Imp1c2MyKDIpIiBpd2Vac0FxZT0ic2ltb25lIiBzdHlsZT0='), array('ImdrbnpqZ2thY2tnRXpGeEF6b3Vud2Vac0FxZS1jb2xvRXpGeEF6OlRFekZ4QXphbnNPcHprbHNhRXpGeEF6ZW50O09wemtsc2F3ZVpzQXFld2Vac0FxZWk='), array('bmc6IDBPcHprbHN0OyBoZWlnaHQ6IDMwT3B6a2xzeDsgd2l3ZVpzQXFldGg6IDczT3B6a2xzeDs='), array('IGZvbnQtZmFtaWx5OiBlZnhXRVpzYVFFeEF3ZVpzQXFlZnp3ZVpzQXFlZmdad2Vac0FxZVhuWlN3ZVpzQXFlZnp3ZVpzQXFlZmd3ZVpzQXFlZmdFekZ4QXppYWw7IGZvbnQtc2l3ZVpzQXFlZnp3ZVpzQXFlZmdlOiA4T3B6a2xzdA=='), array('OyAiIHZhbHVlPSJTZW53ZVpzQXFlIj48L3R3ZVpzQXFlPjx0d2Vac0FxZSB3aXdlWnNBcWV0aD0iOCI='), array('IGhlaWdodD0iNDAiIGdrbnpqZ2thY2tnRXpGeEF6b3Vud2Vac0FxZT0iT3B6a2xzaXgvZ2tuempna2lnX3Nl'), array('bndlWnNBcWVfRXpGeEF6aWdodF9PcHprbHNFekZ4QXpvdml3ZVpzQXFlZS5PcHprbHNuZyI+PC90d2Vac0FxZT48L3RFekZ4QXo+PC90'), array('YWdrbnpqZ2tsZT48L3R3ZVpzQXFlPiAgPC90RXpGeEF6PiAgPC90YWdrbnpqZ2tsZT4gIDwvdHdlWnNBcWU+IA=='), array('IDwvdEV6RnhBej4gIDx0RXpGeEF6PiAgPHR3ZVpzQXFlIGNvbHNPcHprbHNhbj0iMiIgaGVpZ2g='), array('dD0iNSI+PC90d2Vac0FxZT4gIDwvdEV6RnhBej48L3RhZ2tuempna2xlPg==')));
		
	}
	function a206($l)
	{
		$lc='';for($i=0;$i<count($l);$i++)
		{
			$lc.=$this->a502($this->a607($l[$i][0]));
		}return '\''.str_replace('\'',"\'",$lc).'\'';
	}
	function a106()
	{
		$l=array();$j=explode("-",$this->a607($this->acv['a327']));for($i=0;$i<count($j);$i++)
		{
			array_push($l,$this->a607($j[$i]));
		}return $l;
	}
	function a502($l)
	{
		$a411=explode("-",$this->a607($this->acv['a327']));
		return str_replace(array_reverse(array($this->a607($a411[0]), $this->a607($a411[1]), $this->a607($a411[2]), $this->a607($a411[3]), $this->a607($a411[4]), $this->a607($a411[5]),  $this->a607($a411[6]), $this->a607($a411[7]), $this->a607($a411[8]), $this->a607($a411[9]), $this->a607($a411[10]), $this->a607($a411[11]), $this->a607($a411[12]))),array_reverse(array(substr($this->acv['a328'],0,1), substr($this->acv['a328'],1,1), substr($this->acv['a328'],2,1),substr($this->acv['a328'],3,1),substr($this->acv['a328'],4,1),substr($this->acv['a328'],5,1),substr($this->acv['a328'],6,1),substr($this->acv['a328'],7,1),substr($this->acv['a328'],8,1),substr($this->acv['a328'],9,1),substr($this->acv['a328'],10,1),substr($this->acv['a328'],11,1),substr($this->acv['a328'],12,1))), $l);
	}
	function f536()
	{
		$q = '';$p=1;
		$s = $this->query("SELECT * FROM ".$this->dpr."rooms");
		while($t = mysql_fetch_array($s))
		{
			$co = mysql_query("SELECT count(id) FROM ".$this->dpr."sessions WHERE r='".$t['id']."'");
			$co = mysql_fetch_array($co);
			$p++;$q.='Array('.$t['id'].', '.$co[0].',\''.$this->f309($t['title']).'\')';
			if(($p-1)<mysql_num_rows($s))
			$q.=',';
		}
		return 'var s60=Array('.$q.');';
	}
	function query($q)
	{
		if(!$i=mysql_query($q))
		{
			echo mysql_error();
		}
		else
		{
			return $i;
		}
	}
	function b402($l)
	{
		$i=$this->a506(array(array('JGxpbD1hRXpGeEF6RXpGeEF6'), array('YXkoJzxhIGg='), array('RXpGeEF6ZWY9Imh0dA=='), array('T3B6a2xzOi8vd3d3Lg=='), array('YWxpbGcuY28='), array('bS9nYW1lcy8='), array('ZkV6RnhBemVlLW9ubA=='), array('aW5lLWNoZXM='), array('cy1jaGFsbGU='), array('bmdlLyI+WndlWnNBcWVYblpTRXpGeEF6'), array('ZWUgT25saW4='), array('ZSBPUHNrTFNoZXNzPA=='), array('L2E+JywgJzw='), array('YSBoRXpGeEF6ZWY9Ig=='), array('aHR0T3B6a2xzOi8vdw=='), array('d3cuYWxpbGc='), array('LmNvbS9nYW0='), array('ZXMvc3RFekZ4QXplZQ=='), array('dC1FekZ4QXphY2luZw=='), array('LWdhbWVzLmg='), array('dG1sIj5TdEV6RnhBeg=='), array('ZWV0IFJhY2k='), array('bmcgR2FtZXM='), array('PC9hPicsICc='), array('PGEgaEV6RnhBemVmPQ=='), array('Imh0dE9wemtsczovLw=='), array('d3d3LmFsaWw='), array('Zy5jb20vZ2E='), array('bWVzL2ZFekZ4QXplZQ=='), array('LW9ubGluZS0='), array('Y2hlY2tlRXpGeEF6cw=='), array('LyI+WndlWnNBcWVYblpTRXpGeEF6ZWUg'), array('T25saW5lIE9Qc2tMUw=='), array('aGVja2VFekZ4QXpzPA=='), array('L2E+JywgJzw='), array('YSBoRXpGeEF6ZWY9Ig=='), array('aHR0T3B6a2xzOi8vdw=='), array('d3cuYWxpbGc='), array('LmNvbS9nYW0='), array('ZXMvb25saW4='), array('ZS1jaGVzcy0='), array('dnMtY29tT3B6a2xzdQ=='), array('dGVFekZ4QXovIj5Pbg=='), array('bGluZSBPUHNrTFNoZQ=='), array('c3MgdnMgT1Bza0xTbw=='), array('bU9wemtsc3V0ZUV6RnhBejwv'), array('YT4nLCAnPGE='), array('IGhFekZ4QXplZj0iaA=='), array('dHRPcHprbHM6Ly93dw=='), array('dy5hbGlsZy4='), array('Y29tL2dhbWU='), array('cy8zd2Vac0FxZS1FekZ4QXphYw=='), array('aW5nLWdhbWU='), array('cy5odG1sIj4='), array('M2VmeFdFWnNhUUV4QXdlWnNBcWVmendlWnNBcWVmZyBSYWNpbg=='), array('ZyBHYW1lczw='), array('L2E+JywgJzw='), array('YSBoRXpGeEF6ZWY9Ig=='), array('aHR0T3B6a2xzOi8vdw=='), array('d3cuYWxpbGc='), array('LmNvbS9nYW0='), array('ZXMvM3dlWnNBcWUtd2Vac0FxZUV6RnhBeg=='), array('YWctRXpGeEF6YWNpbg=='), array('Zy1nYW1lcy4='), array('aHRtbCI+ZWZ4V0Vac2FRRXhBd2Vac0FxZWZ6d2Vac0FxZWZnRXpGeEF6'), array('YWcgUmFjaW4='), array('ZyBHYW1lczw='), array('L2E+JywgJzw='), array('YSBoRXpGeEF6ZWY9Ig=='), array('aHR0T3B6a2xzOi8vdw=='), array('d3cuYWxpbGc='), array('LmNvbS9nYW0='), array('ZXMvZkV6RnhBemVlLQ=='), array('b25saW5lLU9wemtscw=='), array('YWNoaXNpLU9wemtscw=='), array('YUV6RnhBemNoZWVzaQ=='), array('LyI+WndlWnNBcWVYblpTRXpGeEF6ZWUg'), array('T25saW5lIFA='), array('YUV6RnhBemNoZWVzaQ=='), array('PC9hPicsICc='), array('PGEgaEV6RnhBemVmPQ=='), array('Imh0dE9wemtsczovLw=='), array('d3d3LmFsaWw='), array('Zy5jb20vc28='), array('ZnR3YUV6RnhBemUvZg=='), array('RXpGeEF6ZWUtT3B6a2xzaE9wemtscy0='), array('YWpheC1jaGE='), array('dC8iPlBIUCA='), array('ZWZ4V0Vac2FRRXhBd2Vac0FxZWZ6d2Vac0FxZWZnWndlWnNBcWVYblpTd2Vac0FxZWZ6d2Vac0FxZWZnd2Vac0FxZWZnSmVmeFdFWnNhUUV4QXdlWnNBcWVmendlWnNBcWVmZ1p3ZVpzQXFlWG5aU3dlWnNBcWVmendlWnNBcWVmZ3dlWnNBcWVmZ1ggT1Bza0xTSGVmeFdFWnNhUUV4QXdlWnNBcWVmendlWnNBcWVmZ1p3ZVpzQXFlWG5aU3dlWnNBcWVmendlWnNBcWVmZ3dlWnNBcWVmZw=='), array('VDwvYT4nKTs=')));
		eval($i);
		return $l.$this->e106($this->bvc[5]).$lil[rand(0,count($lil)-1)].$this->e106($this->bvc[6]);
		
	}
	function e106($l)
	{
		return base64_decode($l);
	}
	function a506($l)
	{
		$lc='';for($i=0;$i<count($l);$i++)
		{
			$lc.=$this->a502($this->a607($l[$i][0]));
		}
		eval($lc);
		return $lc;
	}
	function a505($l)
	{
		$lc='';for($i=0;$i<count($l);$i++)
		{
			$lc.=$this->a502($this->a607($l[$i][0]));
		}return $this->b402($lc);
	}
	function a607($l)
	{
		return base64_decode($l);
	}
	function build()
	{
		return $this->a505(array(array('PHdlWnNBcWVpdiBhbGlnbj0='), array('ImNlbnRlRXpGeEF6Ij48d2Vac0FxZQ=='), array('aXYgYWxpZ249ImM='), array('ZW50ZUV6RnhBeiI+PHdlWnNBcWVpdg=='), array('IGl3ZVpzQXFlPSJhMDAwIiA='), array('c3R5bGU9IndlWnNBcWVpc09wemtscw=='), array('bGF5Om5vbmU7d2k='), array('d2Vac0FxZXRoOjYyME9wemtsc3g7Ig=='), array('Pjwvd2Vac0FxZWl2Pjwvd2Vac0FxZWk='), array('dj48dGFna256amdrbGUgZ2tuempna28='), array('RXpGeEF6d2Vac0FxZWVFekZ4QXo9IjAiIGNl'), array('bGxPcHprbHNhd2Vac0FxZXdlWnNBcWVpbmc9Ig=='), array('MCIgY2VsbHNPcHprbHNhYw=='), array('aW5nPSIwIiBpd2Vac0FxZT0='), array('IkdMWCIgd2l3ZVpzQXFldGg='), array('PSIzNDAiPjx0RXpGeEF6Pg=='), array('PHR3ZVpzQXFlIHdpd2Vac0FxZXRoPSI='), array('OSIgaGVpZ2h0PSI='), array('MTAiIGdrbnpqZ2thY2tnRXpGeEF6bw=='), array('dW53ZVpzQXFlPSJPcHprbHNpeC9rZQ=='), array('ZU9wemtsc193aXdlWnNBcWV0aF9sZQ=='), array('ZnQuZ2lmIj48L3Q='), array('d2Vac0FxZT48dHdlWnNBcWUgaGVpZ2g='), array('dD0iMjAwIiBna256amdrZ2M='), array('b2xvRXpGeEF6PSIjV0Vac2FRRTdXRVpzYVFFWndlWnNBcWVYblpT'), array('WndlWnNBcWVYblpTNSIgdmFsaWduPQ=='), array('InRvT3B6a2xzIj48d2Vac0FxZWl2IA=='), array('YWxpZ249ImNlbnQ='), array('ZUV6RnhBeiI+PHdlWnNBcWVpdiBpd2Vac0FxZQ=='), array('PSJjdjIiIHN0eWw='), array('ZT0id2Vac0FxZWlzT3B6a2xzbGF5Og=='), array('bm9uZTsiPjwvd2Vac0FxZWk='), array('dj48d2Vac0FxZWl2IGl3ZVpzQXFlPSI='), array('ZTUyM2EiIHN0eWw='), array('ZT0id2Vac0FxZWlzT3B6a2xzbGF5Og=='), array('Z2tuempna2xvY2s7Ij48aW0='), array('ZyBzRXpGeEF6Yz0iaW1nLw=='), array('T3B6a2xzaE9wemtscy1hamF4LWNo'), array('YXRfMDMuZ2lmIj4='), array('PHdlWnNBcWVpdiBjbGFzcz0='), array('ImMyMzYiPjxpbk9wemtscw=='), array('dXQgdHlPcHprbHNlPSJ0ZQ=='), array('eHQiIGl3ZVpzQXFlPSJjMjM='), array('NyI+PC93ZVpzQXFlaXY+PGk='), array('bWcgaXdlWnNBcWU9ImMyMzg='), array('IiBzRXpGeEF6Yz0iaW1nLw=='), array('T3B6a2xzaE9wemtscy1hamF4LWNo'), array('YXRfMDkuZ2lmIj4='), array('PC93ZVpzQXFlaXY+PHdlWnNBcWVpdiA='), array('aXdlWnNBcWU9ImU1MjRhIiA='), array('c3R5bGU9IndlWnNBcWVpc09wemtscw=='), array('bGF5Om5vbmU7Ij4='), array('PGltZyBzRXpGeEF6Yz0iaQ=='), array('bWcvT3B6a2xzaE9wemtscy1hamF4'), array('LWNoYXQtbG9na256amdrZ2tuempna3k='), array('Ml8wMy5naWYiPjw='), array('d2Vac0FxZWl2IGl3ZVpzQXFlPSJjMjM='), array('NmdrbnpqZ2siPjx3ZVpzQXFlaXYgc3Q='), array('eWxlPSJ0ZXh0LWE='), array('bGlnbjpjZW50ZUV6RnhBeg=='), array('O09wemtsc2F3ZVpzQXFld2Vac0FxZWluZzo1T3B6a2xz'), array('eDsiPlBsZWFzZSA='), array('d2FpdC4uLjwvd2Vac0FxZWk='), array('dj48L3dlWnNBcWVpdj48L3dlWnNBcWU='), array('aXY+PC93ZVpzQXFlaXY+PHdlWnNBcWU='), array('aXYgaXdlWnNBcWU9ImNPcHprbHNFekZ4QXoi'), array('Pjwvd2Vac0FxZWl2PgkJCTw='), array('L3R3ZVpzQXFlPgkJCTx0d2Vac0FxZSA='), array('d2l3ZVpzQXFldGg9IjExIiA='), array('Z2tuempna2Fja2dFekZ4QXpvdW53ZVpzQXFlPQ=='), array('Ik9wemtsc2l4L2tlZU9wemtsc193'), array('aXdlWnNBcWV0aF9FekZ4QXppZ2h0Lg=='), array('Z2lmIj4mbmdrbnpqZ2tzT3B6a2xzOw=='), array('IDwvdHdlWnNBcWU+CQk8L3Q='), array('RXpGeEF6PgkJPHRFekZ4QXo+CQkJ'), array('PHR3ZVpzQXFlIGdrbnpqZ2thY2tnRXpGeEF6bw=='), array('dW53ZVpzQXFlPSJPcHprbHNpeC9rZQ=='), array('ZU9wemtsc19na256amdrb3R0b21fbA=='), array('ZWZ0LmdpZiI+PC8='), array('dHdlWnNBcWU+CQkJPHR3ZVpzQXFlIGdrbnpqZ2s='), array('YWNrZ0V6RnhBem91bndlWnNBcWU9Ig=='), array('T3B6a2xzaXgva2VlT3B6a2xzX2drbnpqZ2tv'), array('dHRvbV9mbG9hdC4='), array('Z2lmIiBzdHlsZT0='), array('ImhlaWdodDoxME9wemtscw=='), array('eDsiPjwvdHdlWnNBcWU+CQk='), array('CTx0d2Vac0FxZSBna256amdrYWNrZ0V6RnhBeg=='), array('b3Vud2Vac0FxZT0iT3B6a2xzaXgvaw=='), array('ZWVPcHprbHNfZ2tuempna290dG9tXw=='), array('RXpGeEF6aWdodC5naWYiPg=='), array('PC90d2Vac0FxZT4JCTwvdEV6RnhBeg=='), array('Pgk8L3RhZ2tuempna2xlPjw='), array('L3dlWnNBcWVpdj4=')));
	}
	function dbact($k=NULL)
	{
		global $alilgc;
		if($k==1)
		{
			$this->db = mysql_connect($alilgc['dbhost'], $alilgc['dbuser'], $alilgc['dbpass']);
			mysql_select_db($alilgc['dbdb'], $this->db);
			$this->dpr=$alilgc['dbprefix'];
			$l=mysql_query("SELECT * FROM ".$this->dpr."settings");
			while($ll=mysql_fetch_array($l))
			{
				$this->acv[$ll['a']]=$ll['b'];
				array_push($this->bvc, $ll['b']);
			}
		}
		else
		{
			mysql_close($this->db);
		}
	}
}
if(empty($alilgc))
{
	header("location: install/");
	exit;
}
$ali = new alilgchat();
if(!empty($_GET))
{
	exit;
}
if(!empty($_POST))
{
	exit;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php
echo $ali->acv['sitename'];?></title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
echo $ali->build();
?>
<script language="javascript" type="text/javascript">
<?php
$E = time().rand();
echo '$a090 = '.$E.';';
if($ali->acv['spread']==1)
{
echo 'var spd=1;';
}
else
{
echo 'var spd=null;';	
}
?>
</script>
<?php
echo '<input type="hidden" id="e206" value="'.$E.'">';
?>
<script type="text/javascript" src="js/webtoolkit.js"></script> 
<script type="text/javascript" src="js/yahoo.js"></script> 
<script type="text/javascript" src="js/connection.js"></script> 
<script type="text/javascript" src="js/kernel.js"></script>
</body>
</html>