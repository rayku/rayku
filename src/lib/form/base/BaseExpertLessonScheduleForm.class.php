<?php

/**
 * ExpertLessonSchedule form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertLessonScheduleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'date'             => new sfWidgetFormInput(),
      'timings'          => new sfWidgetFormInput(),
      'user_id'          => new sfWidgetFormInput(),
      'expert_lesson_id' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'ExpertLessonSchedule', 'column' => 'id', 'required' => false)),
      'date'             => new sfValidatorInteger(),
      'timings'          => new sfValidatorString(array('max_length' => 100)),
      'user_id'          => new sfValidatorInteger(),
      'expert_lesson_id' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('expert_lesson_schedule[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertLessonSchedule';
  }


}
