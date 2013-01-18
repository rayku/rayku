<?php

/**
 * NotificationEmails form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseNotificationEmailsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'user_id' => new sfWidgetFormInput(),
      'on_off'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'NotificationEmails', 'column' => 'id', 'required' => false)),
      'user_id' => new sfValidatorInteger(),
      'on_off'  => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('notification_emails[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NotificationEmails';
  }


}
