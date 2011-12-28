<?php

/**
 * ExpertLesson form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertLessonForm extends BaseFormPropel
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
      'day'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'ExpertLesson', 'column' => 'id', 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 100)),
      'content'    => new sfValidatorString(),
      'price'      => new sfValidatorNumber(),
      'user_id'    => new sfValidatorInteger(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'day'        => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('expert_lesson[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertLesson';
  }


}
