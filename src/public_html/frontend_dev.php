<?php
$time=microtime(true);

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
$controller=sfContext::getInstance()->getModuleName();
$action=sfContext::getInstance()->getActionName();

$stat_name='rayku.'.$controller.'.'.$action;
$time = (microtime(true) - $time) * 1000;
StatsD::timing($stat_name,$time);
