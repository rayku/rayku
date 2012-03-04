<body style="font-family:Tahoma;font-size:24px;margin:50px auto">
<?php if ($sf_user->isAuthenticated()){ 
	echo '<script type="text/javascript"> window.location = "http://www.rayku.com/dashboard" </script> You do not have javascript enabled. <a href="http://www.rayku.com/dashboard">Click here</a> to continue.';
	}
	else {
	echo '<script type="text/javascript"> window.location = "http://www.rayku.com/start" </script> You are being redirected... <a href="http://www.rayku.com/start">Click here</a> to continue.';
	}
?>
<!--<div align="center">
	Finishing up some last-minute tweaks, stay tuned!
</div>
<div align="center" style="font-size:12px;color:#CCC;margin-top:20px;">
	<a href="/start" style="color:#006699;text-decoration:none">Continue Anyway</a> (but don't break anything!) | <a href="/login" style="color:#006699;text-decoration:none">Beta Users</a>
</div>-->
</body>