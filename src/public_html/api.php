<?php

$allowedIps = array('127.0.0.1','10.180.146.105');

if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIps)) {
    die('get out!!!');
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('api', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
