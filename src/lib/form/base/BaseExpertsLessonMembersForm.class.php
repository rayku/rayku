<?php

/**
 * ExpertsLessonMembers form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsLessonMembersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'student_id'  => new sfWidgetFormInput(),
      'category_id' => new sfWidgetFormInput(),
      'expert_id'   => new sfWidgetFormInput(),
      'lesson_id'   => new sfWidgetFormInput(),
      'approve'     => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'ExpertsLessonMembers', 'column' => 'id', 'required' => false)),
      'student_id'  => new sfValidatorInteger(),
      'category_id' => new sfValidatorInteger(),
      'expert_id'   => new sfValidatorInteger(),
      'lesson_id'   => new sfValidatorInteger(),
      'approve'     => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('experts_lesson_members[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsLessonMembers';
  }


}
