<?php

/**
 * WhiteboardSnapshot form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseWhiteboardSnapshotForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'whiteboard_chat_id' => new sfWidgetFormPropelChoice(array('model' => 'WhiteboardChat', 'add_empty' => false)),
      'filename'           => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'WhiteboardSnapshot', 'column' => 'id', 'required' => false)),
      'whiteboard_chat_id' => new sfValidatorPropelChoice(array('model' => 'WhiteboardChat', 'column' => 'id')),
      'filename'           => new sfValidatorString(array('max_length' => 255)),
      'created_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_snapshot[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardSnapshot';
  }


}
