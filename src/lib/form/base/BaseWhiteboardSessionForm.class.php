<?php

/**
 * WhiteboardSession form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseWhiteboardSessionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'question_id'   => new sfWidgetFormPropelChoice(array('model' => 'StudentQuestion', 'add_empty' => false)),
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'type'          => new sfWidgetFormInput(),
      'token'         => new sfWidgetFormInput(),
      'chat_id'       => new sfWidgetFormInput(),
      'last_activity' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'WhiteboardSession', 'column' => 'id', 'required' => false)),
      'question_id'   => new sfValidatorPropelChoice(array('model' => 'StudentQuestion', 'column' => 'id')),
      'user_id'       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'type'          => new sfValidatorInteger(),
      'token'         => new sfValidatorString(array('max_length' => 40)),
      'chat_id'       => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'last_activity' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_session[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardSession';
  }


}
