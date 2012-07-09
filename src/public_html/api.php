<?php

$allowedIps = array('127.0.0.1');

if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIps)) {
    die('get out!!!');
}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('api', 'prod', false);

require_once dirname(__DIR__) . '/lib/vendor/RaykuCommunicationChannelService/src/load.php';

sfContext::createInstance($configuration)->dispatch();
