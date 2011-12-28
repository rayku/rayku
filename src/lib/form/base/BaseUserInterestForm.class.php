<?php

/**
 * UserInterest form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserInterestForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'user_id'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'interest' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'UserInterest', 'column' => 'id', 'required' => false)),
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'interest' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_interest[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserInterest';
  }


}
