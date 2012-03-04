<?php
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

require_once( dirname( __FILE__ ) . '/classroomAppDetector.php' );
$app = classroomAppDetector( $_SERVER['REQUEST_URI'], 'frontend' );

$configuration = ProjectConfiguration::getApplicationConfiguration($app, 'prod', false);
sfContext::createInstance($configuration)->dispatch();
