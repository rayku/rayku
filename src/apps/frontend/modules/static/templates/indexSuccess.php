<body style="font-family:Verdana, Geneva, sans-serif">
<?php if ($sf_user->isAuthenticated()){ 
	echo '<script type="text/javascript"> window.location = "http://www.rayku.com/dashboard" </script> You do not have javascript enabled. <a href="http://www.rayku.com/dashboard">Click here</a> to continue.';
	}
	else {
	echo '<script type="text/javascript"> window.location = "http://www.rayku.com/start" </script> You are being redirected... <a href="http://www.rayku.com/start">Click here</a> to continue.';
	}
?>
</body>