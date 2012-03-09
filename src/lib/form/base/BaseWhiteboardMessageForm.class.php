<?php

/**
 * WhiteboardMessage form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseWhiteboardMessageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'whiteboard_chat_id' => new sfWidgetFormPropelChoice(array('model' => 'WhiteboardChat', 'add_empty' => false)),
      'user_id'            => new sfWidgetFormInput(),
      'message'            => new sfWidgetFormTextarea(),
      'created_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'WhiteboardMessage', 'column' => 'id', 'required' => false)),
      'whiteboard_chat_id' => new sfValidatorPropelChoice(array('model' => 'WhiteboardChat', 'column' => 'id')),
      'user_id'            => new sfValidatorInteger(array('required' => false)),
      'message'            => new sfValidatorString(array('required' => false)),
      'created_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardMessage';
  }


}
