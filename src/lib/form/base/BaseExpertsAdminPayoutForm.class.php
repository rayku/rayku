<?php

/**
 * ExpertsAdminPayout form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsAdminPayoutForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'expert_id' => new sfWidgetFormInput(),
      'amount'    => new sfWidgetFormInput(),
      'paypal_id' => new sfWidgetFormInput(),
      'paid'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ExpertsAdminPayout', 'column' => 'id', 'required' => false)),
      'expert_id' => new sfValidatorInteger(),
      'amount'    => new sfValidatorNumber(),
      'paypal_id' => new sfValidatorString(array('max_length' => 100)),
      'paid'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('experts_admin_payout[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsAdminPayout';
  }


}
