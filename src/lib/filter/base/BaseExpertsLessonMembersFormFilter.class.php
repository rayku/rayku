<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertsLessonMembers filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertsLessonMembersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'student_id'  => new sfWidgetFormFilterInput(),
      'category_id' => new sfWidgetFormFilterInput(),
      'expert_id'   => new sfWidgetFormFilterInput(),
      'lesson_id'   => new sfWidgetFormFilterInput(),
      'approve'     => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'student_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'lesson_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'approve'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('experts_lesson_members_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsLessonMembers';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'student_id'  => 'Number',
      'category_id' => 'Number',
      'expert_id'   => 'Number',
      'lesson_id'   => 'Number',
      'approve'     => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
