<?php

/**
 * Courses form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseCoursesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => false)),
      'course_name' => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Courses', 'column' => 'id', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id')),
      'course_name' => new sfValidatorString(array('max_length' => 200)),
      'description' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('courses[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Courses';
  }


}
