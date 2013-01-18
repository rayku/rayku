<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserGtalk filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserGtalkFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'gtalkid' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'gtalkid' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_gtalk_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserGtalk';
  }

  public function getFields()
  {
    return array(
      'userid'  => 'ForeignKey',
      'gtalkid' => 'Text',
    );
  }
}
