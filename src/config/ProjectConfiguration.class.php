<?php

require_once dirname(dirname( __FILE__ )) . '/lib/vendor/symfony1.2/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
      $this->enableAllPluginsExcept(array('sfDoctrinePlugin'));
      $this->setWebDir(dirname(dirname(__FILE__)).'/public_html');
  }
}
