<?php

/**
 * StudentQuestion form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseStudentQuestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'checked_id'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'category_id' => new sfWidgetFormInput(),
      'course_id'   => new sfWidgetFormInput(),
      'question'    => new sfWidgetFormInput(),
      'exe_order'   => new sfWidgetFormInput(),
      'time'        => new sfWidgetFormInput(),
      'course_code' => new sfWidgetFormInput(),
      'year'        => new sfWidgetFormInput(),
      'school'      => new sfWidgetFormInput(),
      'status'      => new sfWidgetFormInput(),
      'close'       => new sfWidgetFormInput(),
      'cron'        => new sfWidgetFormInput(),
      'source'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'StudentQuestion', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'checked_id'  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'category_id' => new sfValidatorInteger(),
      'course_id'   => new sfValidatorInteger(),
      'question'    => new sfValidatorString(array('max_length' => 500)),
      'exe_order'   => new sfValidatorInteger(),
      'time'        => new sfValidatorInteger(),
      'course_code' => new sfValidatorString(array('max_length' => 100)),
      'year'        => new sfValidatorString(array('max_length' => 100)),
      'school'      => new sfValidatorString(array('max_length' => 100)),
      'status'      => new sfValidatorInteger(),
      'close'       => new sfValidatorInteger(),
      'cron'        => new sfValidatorInteger(),
      'source'      => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('student_question[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentQuestion';
  }


}
