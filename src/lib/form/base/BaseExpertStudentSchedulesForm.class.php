<?php

/**
 * ExpertStudentSchedules form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertStudentSchedulesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'exp_id'           => new sfWidgetFormInput(),
      'student_id'       => new sfWidgetFormInput(),
      'date'             => new sfWidgetFormInput(),
      'time'             => new sfWidgetFormInput(),
      'message'          => new sfWidgetFormTextarea(),
      'expert_lesson_id' => new sfWidgetFormInput(),
      'accept_reject'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'ExpertStudentSchedules', 'column' => 'id', 'required' => false)),
      'exp_id'           => new sfValidatorInteger(),
      'student_id'       => new sfValidatorInteger(),
      'date'             => new sfValidatorInteger(),
      'time'             => new sfValidatorInteger(),
      'message'          => new sfValidatorString(),
      'expert_lesson_id' => new sfValidatorInteger(),
      'accept_reject'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('expert_student_schedules[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertStudentSchedules';
  }


}
