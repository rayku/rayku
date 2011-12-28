<?php

/**
 * StudentsInstantQuestions form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseStudentsInstantQuestionsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'student_question' => new sfWidgetFormTextarea(),
      'student_id'       => new sfWidgetFormInput(),
      'expert_id'        => new sfWidgetFormInput(),
      'experts_accept'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'StudentsInstantQuestions', 'column' => 'id', 'required' => false)),
      'student_question' => new sfValidatorString(),
      'student_id'       => new sfValidatorInteger(),
      'expert_id'        => new sfValidatorInteger(),
      'experts_accept'   => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('students_instant_questions[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentsInstantQuestions';
  }


}
