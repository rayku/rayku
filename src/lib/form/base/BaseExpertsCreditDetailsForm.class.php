<?php

/**
 * ExpertsCreditDetails form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsCreditDetailsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'student_id'          => new sfWidgetFormInput(),
      'expert_id'           => new sfWidgetFormInput(),
      'credit_amount'       => new sfWidgetFormInput(),
      'lesson_id'           => new sfWidgetFormInput(),
      'immediate_lesson_id' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorPropelChoice(array('model' => 'ExpertsCreditDetails', 'column' => 'id', 'required' => false)),
      'student_id'          => new sfValidatorInteger(),
      'expert_id'           => new sfValidatorInteger(),
      'credit_amount'       => new sfValidatorNumber(),
      'lesson_id'           => new sfValidatorInteger(),
      'immediate_lesson_id' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('experts_credit_details[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsCreditDetails';
  }


}
