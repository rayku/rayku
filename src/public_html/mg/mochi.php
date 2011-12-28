<?php 
define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/../..'));
define('SF_APP',         'frontend');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       true);
require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
$user=sfContext::getInstance()->getUser()->getUser();
?>
<script type="text/javascript">
var username = "<?= $user->getUsername(); ?>";
var userid = "<?= $user->getId() ?>";
var points_count = "<?= $user->getPoints(); ?>";

function GetInfoFromJS(){

	var Myinfo = username+","+userid+","+points_count;

    if(username!=""){ 
		document.mochigame.SetInfoToFlash( Myinfo );  
	}
}
</script>
<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="AC_RunActiveContent.js" language="javascript"></script>
</head>
<body bgcolor="#ffffff">

<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("此页需要 AC_RunActiveContent.js");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '550',
			'height', '400',
			'src', '/mg/mochigame',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'mochigame',
			'bgcolor', '#ffffff',
			'name', 'mochigame',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '/mg/mochigame',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="550" height="400" id="mochigame" align="middle">
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="loading.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="loading.swf" quality="high" bgcolor="#ffffff" width="550" height="400" name="mochigame" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
	</object>
</noscript>
</body>
</html>
