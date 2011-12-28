<?php

/**
 * ExpertsFinalCredit form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsFinalCreditForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'expert_id' => new sfWidgetFormInput(),
      'amount'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ExpertsFinalCredit', 'column' => 'id', 'required' => false)),
      'expert_id' => new sfValidatorInteger(),
      'amount'    => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('experts_final_credit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsFinalCredit';
  }


}
