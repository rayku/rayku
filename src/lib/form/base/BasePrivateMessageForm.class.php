<?php

/**
 * PrivateMessage form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BasePrivateMessageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'subject'      => new sfWidgetFormInput(),
      'body'         => new sfWidgetFormTextarea(),
      'sender_id'    => new sfWidgetFormInput(),
      'recipient_id' => new sfWidgetFormInput(),
      'status'       => new sfWidgetFormInput(),
      'read_status'  => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'type'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'PrivateMessage', 'column' => 'id', 'required' => false)),
      'subject'      => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'body'         => new sfValidatorString(array('required' => false)),
      'sender_id'    => new sfValidatorInteger(array('required' => false)),
      'recipient_id' => new sfValidatorInteger(array('required' => false)),
      'status'       => new sfValidatorInteger(array('required' => false)),
      'read_status'  => new sfValidatorInteger(array('required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'type'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('private_message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PrivateMessage';
  }


}
