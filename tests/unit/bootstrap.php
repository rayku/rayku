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

