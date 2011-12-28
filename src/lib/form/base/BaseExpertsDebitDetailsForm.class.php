<?php

/**
 * ExpertsDebitDetails form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsDebitDetailsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'expert_id' => new sfWidgetFormInput(),
      'amount'    => new sfWidgetFormInput(),
      'time'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ExpertsDebitDetails', 'column' => 'id', 'required' => false)),
      'expert_id' => new sfValidatorInteger(),
      'amount'    => new sfValidatorNumber(),
      'time'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('experts_debit_details[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsDebitDetails';
  }


}
