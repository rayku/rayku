<?php

/**
 * UserQuestionTag form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserQuestionTagForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'course_id'   => new sfWidgetFormPropelChoice(array('model' => 'Courses', 'add_empty' => true)),
      'course_code' => new sfWidgetFormInput(),
      'education'   => new sfWidgetFormInput(),
      'school'      => new sfWidgetFormInput(),
      'year'        => new sfWidgetFormInput(),
      'question'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'UserQuestionTag', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'course_id'   => new sfValidatorPropelChoice(array('model' => 'Courses', 'column' => 'id', 'required' => false)),
      'course_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'education'   => new sfValidatorInteger(array('required' => false)),
      'school'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'year'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'question'    => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('user_question_tag[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserQuestionTag';
  }


}
