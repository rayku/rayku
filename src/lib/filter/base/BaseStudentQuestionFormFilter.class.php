<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * StudentQuestion filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseStudentQuestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'checked_id'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'category_id' => new sfWidgetFormFilterInput(),
      'course_id'   => new sfWidgetFormFilterInput(),
      'question'    => new sfWidgetFormFilterInput(),
      'exe_order'   => new sfWidgetFormFilterInput(),
      'time'        => new sfWidgetFormFilterInput(),
      'course_code' => new sfWidgetFormFilterInput(),
      'year'        => new sfWidgetFormFilterInput(),
      'school'      => new sfWidgetFormFilterInput(),
      'status'      => new sfWidgetFormFilterInput(),
      'close'       => new sfWidgetFormFilterInput(),
      'cron'        => new sfWidgetFormFilterInput(),
      'source'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'checked_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'category_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'course_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'question'    => new sfValidatorPass(array('required' => false)),
      'exe_order'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'time'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'course_code' => new sfValidatorPass(array('required' => false)),
      'year'        => new sfValidatorPass(array('required' => false)),
      'school'      => new sfValidatorPass(array('required' => false)),
      'status'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'close'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cron'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'source'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('student_question_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentQuestion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'checked_id'  => 'ForeignKey',
      'category_id' => 'Number',
      'course_id'   => 'Number',
      'question'    => 'Text',
      'exe_order'   => 'Number',
      'time'        => 'Number',
      'course_code' => 'Text',
      'year'        => 'Text',
      'school'      => 'Text',
      'status'      => 'Number',
      'close'       => 'Number',
      'cron'        => 'Number',
      'source'      => 'Text',
    );
  }
}
