<?php

/**
 * ExpertsImmediateLesson form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsImmediateLessonForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInput(),
      'content'    => new sfWidgetFormTextarea(),
      'price'      => new sfWidgetFormInput(),
      'user_id'    => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'ExpertsImmediateLesson', 'column' => 'id', 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 50)),
      'content'    => new sfValidatorString(),
      'price'      => new sfValidatorNumber(),
      'user_id'    => new sfValidatorInteger(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('experts_immediate_lesson[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsImmediateLesson';
  }


}
