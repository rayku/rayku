<?php

/**
 * ClassroomForum form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomForumForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'forum_name'   => new sfWidgetFormInput(),
      'description'  => new sfWidgetFormTextarea(),
      'classroom_id' => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'ClassroomForum', 'column' => 'id', 'required' => false)),
      'forum_name'   => new sfValidatorString(array('max_length' => 50)),
      'description'  => new sfValidatorString(),
      'classroom_id' => new sfValidatorInteger(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('classroom_forum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomForum';
  }


}
