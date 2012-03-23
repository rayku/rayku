<?php
require_once dirname(__FILE__) . '/../../src/lib/vendor/phake/src/Phake.php';
require_once dirname(__FILE__) . '/../../src/lib/vendor/symfony1/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(__FILE__) . '/../../src/config/ProjectConfiguration.class.php';

function when($object)
{
    return Phake::when($object);
}

function mock($className)
{
    return Phake::mock($className);
}

$autoloader = sfCoreAutoload::getInstance();
$autoloader->register();

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'unit-tests', true);
sfContext::createInstance($configuration);

?>

