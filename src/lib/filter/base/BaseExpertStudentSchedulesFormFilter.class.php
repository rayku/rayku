<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertStudentSchedules filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertStudentSchedulesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'exp_id'           => new sfWidgetFormFilterInput(),
      'student_id'       => new sfWidgetFormFilterInput(),
      'date'             => new sfWidgetFormFilterInput(),
      'time'             => new sfWidgetFormFilterInput(),
      'message'          => new sfWidgetFormFilterInput(),
      'expert_lesson_id' => new sfWidgetFormFilterInput(),
      'accept_reject'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'exp_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'student_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'time'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'message'          => new sfValidatorPass(array('required' => false)),
      'expert_lesson_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'accept_reject'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('expert_student_schedules_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertStudentSchedules';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'exp_id'           => 'Number',
      'student_id'       => 'Number',
      'date'             => 'Number',
      'time'             => 'Number',
      'message'          => 'Text',
      'expert_lesson_id' => 'Number',
      'accept_reject'    => 'Number',
    );
  }
}
