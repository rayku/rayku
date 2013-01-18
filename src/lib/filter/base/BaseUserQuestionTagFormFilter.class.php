<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserQuestionTag filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserQuestionTagFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'course_id'   => new sfWidgetFormPropelChoice(array('model' => 'Courses', 'add_empty' => true)),
      'course_code' => new sfWidgetFormFilterInput(),
      'education'   => new sfWidgetFormFilterInput(),
      'school'      => new sfWidgetFormFilterInput(),
      'year'        => new sfWidgetFormFilterInput(),
      'question'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'category_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
      'course_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Courses', 'column' => 'id')),
      'course_code' => new sfValidatorPass(array('required' => false)),
      'education'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'school'      => new sfValidatorPass(array('required' => false)),
      'year'        => new sfValidatorPass(array('required' => false)),
      'question'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_question_tag_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserQuestionTag';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'category_id' => 'ForeignKey',
      'course_id'   => 'ForeignKey',
      'course_code' => 'Text',
      'education'   => 'Number',
      'school'      => 'Text',
      'year'        => 'Text',
      'question'    => 'Text',
    );
  }
}
