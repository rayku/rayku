<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', false);

require_once dirname(__DIR__) . '/lib/vendor/RaykuCommunicationChannelService/src/load.php';

sfContext::createInstance($configuration)->dispatch();
