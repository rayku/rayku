<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserInterest filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserInterestFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'interest' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'interest' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_interest_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserInterest';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'user_id'  => 'ForeignKey',
      'interest' => 'Text',
    );
  }
}
