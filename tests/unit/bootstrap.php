<?php

// Project root
define('PROJROOT', realpath(dirname(__FILE__) . '/../../src/') . '/');

// Phake auto loading needs some cuddling
set_include_path(get_include_path() . PATH_SEPARATOR . realpath(__DIR__ . '/../../src/lib/vendor/phake/src'));

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

// This has to be done, so proper environment config files gets loaded
$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
sfContext::createInstance($configuration);
unset($configuration);

$coreAutoload = sfCoreAutoload::getInstance();
$coreAutoload->register();

$simpleAutoload = sfSimpleAutoload::getInstance();
$simpleAutoload->addDirectory(realpath(__DIR__ . '/../../src/lib/vendor'));
$simpleAutoload->addDirectory(realpath(__DIR__ . '/../../src/apps/frontend/lib'));
$simpleAutoload->addDirectory(realpath(__DIR__ . '/../../src/lib/model'));
$simpleAutoload->register();


class SymfonyActionTestCase extends PHPUnit_Framework_TestCase
{
    protected $request;
    protected $context;

    protected function setUp()
    {
        parent::setUp();
        $configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'test', true);
        $this->context = sfContext::createInstance($configuration);

        $this->request = mock('sfWebRequest');
        $this->context->set('request', $this->request);
    }

    protected function getResponseContents()
    {
        return $this->context->getResponse()->getContent();
    }
}

?>

