<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertLessonSchedule filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertLessonScheduleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'             => new sfWidgetFormFilterInput(),
      'timings'          => new sfWidgetFormFilterInput(),
      'user_id'          => new sfWidgetFormFilterInput(),
      'expert_lesson_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'date'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'timings'          => new sfValidatorPass(array('required' => false)),
      'user_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_lesson_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('expert_lesson_schedule_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertLessonSchedule';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'date'             => 'Number',
      'timings'          => 'Text',
      'user_id'          => 'Number',
      'expert_lesson_id' => 'Number',
    );
  }
}
