<?php

/**
 * UserRate form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserRateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'     => new sfWidgetFormInputHidden(),
      'userid' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'rate'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'     => new sfValidatorPropelChoice(array('model' => 'UserRate', 'column' => 'id', 'required' => false)),
      'userid' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'rate'   => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('user_rate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserRate';
  }


}
