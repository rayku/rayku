<?php

/**
 * Subscription form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseSubscriptionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'notification_type' => new sfWidgetFormInput(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'teacher_id'        => new sfWidgetFormInput(),
      'classroom_id'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'Subscription', 'column' => 'id', 'required' => false)),
      'notification_type' => new sfValidatorInteger(),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'teacher_id'        => new sfValidatorInteger(),
      'classroom_id'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('subscription[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subscription';
  }


}
