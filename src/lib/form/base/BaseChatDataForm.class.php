<?php

/**
 * ChatData form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseChatDataForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_name'   => new sfWidgetFormInput(),
      'expert_name' => new sfWidgetFormInput(),
      'text'        => new sfWidgetFormTextarea(),
      'flag'        => new sfWidgetFormInput(),
      'time'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'ChatData', 'column' => 'id', 'required' => false)),
      'user_name'   => new sfValidatorString(array('max_length' => 100)),
      'expert_name' => new sfValidatorString(array('max_length' => 100)),
      'text'        => new sfValidatorString(),
      'flag'        => new sfValidatorInteger(),
      'time'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('chat_data[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChatData';
  }


}
