<?php

/**
 * StudentVoiceVotes form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseStudentVoiceVotesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'student_voice_id' => new sfWidgetFormPropelChoice(array('model' => 'StudentVoice', 'add_empty' => false)),
      'value'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'StudentVoiceVotes', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'student_voice_id' => new sfValidatorPropelChoice(array('model' => 'StudentVoice', 'column' => 'id')),
      'value'            => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('student_voice_votes[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentVoiceVotes';
  }


}
