<?php

/**
 * WhiteboardTutorFeedback form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseWhiteboardTutorFeedbackForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'whiteboard_chat_id' => new sfWidgetFormPropelChoice(array('model' => 'WhiteboardChat', 'add_empty' => false)),
      'expert_id'          => new sfWidgetFormInput(),
      'audio'              => new sfWidgetFormInput(),
      'usability'          => new sfWidgetFormInput(),
      'overall'            => new sfWidgetFormInput(),
      'feedback'           => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'WhiteboardTutorFeedback', 'column' => 'id', 'required' => false)),
      'whiteboard_chat_id' => new sfValidatorPropelChoice(array('model' => 'WhiteboardChat', 'column' => 'id')),
      'expert_id'          => new sfValidatorInteger(array('required' => false)),
      'audio'              => new sfValidatorInteger(),
      'usability'          => new sfValidatorInteger(),
      'overall'            => new sfValidatorInteger(),
      'feedback'           => new sfValidatorString(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_tutor_feedback[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardTutorFeedback';
  }


}
