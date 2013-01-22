<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * StudentsInstantQuestions filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseStudentsInstantQuestionsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'student_question' => new sfWidgetFormFilterInput(),
      'student_id'       => new sfWidgetFormFilterInput(),
      'expert_id'        => new sfWidgetFormFilterInput(),
      'experts_accept'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'student_question' => new sfValidatorPass(array('required' => false)),
      'student_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'experts_accept'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('students_instant_questions_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentsInstantQuestions';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'student_question' => 'Text',
      'student_id'       => 'Number',
      'expert_id'        => 'Number',
      'experts_accept'   => 'Number',
    );
  }
}
