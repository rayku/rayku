<?php

/**
 * Invitation form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseInvitationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'receiver_email' => new sfWidgetFormInput(),
      'receiver_code'  => new sfWidgetFormInput(),
      'sent'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Invitation', 'column' => 'id', 'required' => false)),
      'user_id'        => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'receiver_email' => new sfValidatorString(array('max_length' => 100)),
      'receiver_code'  => new sfValidatorString(array('max_length' => 100)),
      'sent'           => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('invitation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invitation';
  }


}
