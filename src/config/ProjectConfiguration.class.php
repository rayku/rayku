<?php

require_once dirname(dirname( __FILE__ )) . '/lib/vendor/symfony1/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
	public function setup()
	{
		$this->enableAllPluginsExcept(array('sfDoctrinePlugin'));
		$this->setWebDir(dirname(dirname(__FILE__)).'/public_html');

		$environment = getenv('environment');
		if($environment == 'development'){
			$this->setCacheDir('/tmp/rayku/cache');
			$this->setLogDir('/var/log/rayku');
		}
	}
}
