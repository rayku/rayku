<?php

/**
 * Friend form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseFriendForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id1'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'user_id2'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'status'     => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id1'   => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'user_id2'   => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'status'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'Friend', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('friend[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friend';
  }


}
