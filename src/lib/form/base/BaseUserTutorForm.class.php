<?php

/**
 * UserTutor form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserTutorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'userid' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_tutor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserTutor';
  }


}
