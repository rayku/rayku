<?php

/**
 * StudentVoice form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseStudentVoiceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'title'        => new sfWidgetFormInput(),
      'description'  => new sfWidgetFormTextarea(),
      'status'       => new sfWidgetFormInput(),
      'vote'         => new sfWidgetFormInput(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'StudentVoice', 'column' => 'id', 'required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'title'        => new sfValidatorString(array('max_length' => 100)),
      'description'  => new sfValidatorString(),
      'status'       => new sfValidatorInteger(),
      'vote'         => new sfValidatorInteger(),
      'classroom_id' => new sfValidatorPropelChoice(array('model' => 'Classroom', 'column' => 'id')),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('student_voice[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentVoice';
  }


}
