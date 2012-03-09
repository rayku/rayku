<?php

/**
 * WhiteboardChat form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseWhiteboardChatForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'is_public'       => new sfWidgetFormInput(),
      'expert_id'       => new sfWidgetFormInput(),
      'asker_id'        => new sfWidgetFormInput(),
      'expert_nickname' => new sfWidgetFormInput(),
      'asker_nickname'  => new sfWidgetFormInput(),
      'question'        => new sfWidgetFormTextarea(),
      'started_at'      => new sfWidgetFormDateTime(),
      'ended_at'        => new sfWidgetFormDateTime(),
      'directory'       => new sfWidgetFormInput(),
      'created_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'WhiteboardChat', 'column' => 'id', 'required' => false)),
      'is_public'       => new sfValidatorInteger(),
      'expert_id'       => new sfValidatorInteger(array('required' => false)),
      'asker_id'        => new sfValidatorInteger(array('required' => false)),
      'expert_nickname' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'asker_nickname'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'question'        => new sfValidatorString(array('required' => false)),
      'started_at'      => new sfValidatorDateTime(array('required' => false)),
      'ended_at'        => new sfValidatorDateTime(array('required' => false)),
      'directory'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_chat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardChat';
  }


}
