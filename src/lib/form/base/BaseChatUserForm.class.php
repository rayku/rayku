<?php

/**
 * ChatUser form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseChatUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_name' => new sfWidgetFormInput(),
      'status'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ChatUser', 'column' => 'id', 'required' => false)),
      'user_name' => new sfValidatorString(array('max_length' => 100)),
      'status'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('chat_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChatUser';
  }


}
