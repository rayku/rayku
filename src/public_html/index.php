<?php
$time=microtime(true);

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
