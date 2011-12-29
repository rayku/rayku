<body>
<?php if ($sf_user->isAuthenticated()){
	echo '<script type="text/javascript"> window.location = "http://'.RaykuCommon::getCurrentHttpDomain().'/dashboard" </script> You do not have javascript enabled. <a href="http://'.RaykuCommon::getCurrentHttpDomain().'/dashboard">Click here</a> to continue.';
} else {
	echo '<script type="text/javascript"> window.location = "http://'.RaykuCommon::getCurrentHttpDomain().'/start" </script> You are being redirected... <a href="http://'.RaykuCommon::getCurrentHttpDomain().'/start">Click here</a> to continue.';
}
?>
</body>
