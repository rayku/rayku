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

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'unit-test', true);
sfContext::createInstance($configuration);

chdir(dirname(__FILE__) . '/../../src/');
$dispatcher = new sfEventDispatcher();
$application = new sfSymfonyCommandApplication(
    $dispatcher,
    new sfAnsiColorFormatter(),
    array(
        'symfony_lib_dir' => realpath(dirname(__FILE__).'/../..'),
        'sf_root_dir' => realpath(dirname(__FILE__).'/../../src')
    )
);
$application->run(array('propel:build-sql'));
$application->run(array('propel:insert-sql', '--env="unit-tests"', '--no-confirmation'));
