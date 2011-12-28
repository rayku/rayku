<?php

/**
 * ExpertAvailableDays form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertAvailableDaysForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'expert_id' => new sfWidgetFormInput(),
      'monday'    => new sfWidgetFormInput(),
      'tuesday'   => new sfWidgetFormInput(),
      'wednesday' => new sfWidgetFormInput(),
      'thursday'  => new sfWidgetFormInput(),
      'friday'    => new sfWidgetFormInput(),
      'saturday'  => new sfWidgetFormInput(),
      'sunday'    => new sfWidgetFormInput(),
      'timings'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'ExpertAvailableDays', 'column' => 'id', 'required' => false)),
      'expert_id' => new sfValidatorInteger(),
      'monday'    => new sfValidatorInteger(),
      'tuesday'   => new sfValidatorInteger(),
      'wednesday' => new sfValidatorInteger(),
      'thursday'  => new sfValidatorInteger(),
      'friday'    => new sfValidatorInteger(),
      'saturday'  => new sfValidatorInteger(),
      'sunday'    => new sfValidatorInteger(),
      'timings'   => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('expert_available_days[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertAvailableDays';
  }


}
