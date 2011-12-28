<?php

/**
 * ChatDetail form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseChatDetailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'user'          => new sfWidgetFormInput(),
      'expert'        => new sfWidgetFormInput(),
      'minutes'       => new sfWidgetFormInput(),
      'expert_agreed' => new sfWidgetFormInput(),
      'user_ask'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'ChatDetail', 'column' => 'id', 'required' => false)),
      'user'          => new sfValidatorString(array('max_length' => 100)),
      'expert'        => new sfValidatorString(array('max_length' => 100)),
      'minutes'       => new sfValidatorInteger(),
      'expert_agreed' => new sfValidatorInteger(),
      'user_ask'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('chat_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChatDetail';
  }


}
