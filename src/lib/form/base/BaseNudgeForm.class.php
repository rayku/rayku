<?php

/**
 * Nudge form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseNudgeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_from_id' => new sfWidgetFormInput(),
      'user_to_id'   => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'id'           => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_from_id' => new sfValidatorInteger(array('required' => false)),
      'user_to_id'   => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'id'           => new sfValidatorPropelChoice(array('model' => 'Nudge', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('nudge[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Nudge';
  }


}
