<?php
$time=microtime(true);

$url_array = array(
		'index' => '/',
		'become' => '/become-a-tutor',
		'about' => '/about',
		'tutor-signup' => '/signup-tutor'
);

/*
 Get path from URL
*/
$url = $_SERVER["REQUEST_URI"];

/* 	Test if the path exists in the $url_array
 if it does, use symfony2 routing
else use symfony1 routing
*/
if(in_array($url, $url_array))
{
	/*
		Use the symfony2 app.php file
	*/
	require_once('/var/rayku-v2/web/app.php');
	return;
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$environment = getenv('environment');
if($environment == 'development'){
	$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
}else{
	$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);
}
sfContext::createInstance($configuration)->dispatch();
$controller=sfContext::getInstance()->getModuleName();
$action=sfContext::getInstance()->getActionName();

$stat_name=$controller.'.'.$action;
$time = (microtime(true) - $time) * 1000;
StatsD::timing($stat_name,$time);
StatsD::timing('render', $time);
