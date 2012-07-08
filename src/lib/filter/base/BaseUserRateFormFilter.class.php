<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserRate filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserRateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'rate'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'userid' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'rate'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('user_rate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserRate';
  }

  public function getFields()
  {
    return array(
      'id'     => 'Number',
      'userid' => 'ForeignKey',
      'rate'   => 'Number',
    );
  }
}
