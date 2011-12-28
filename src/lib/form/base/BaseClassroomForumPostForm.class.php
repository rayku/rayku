<?php

/**
 * ClassroomForumPost form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomForumPostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInput(),
      'content'    => new sfWidgetFormTextarea(),
      'poster_id'  => new sfWidgetFormInput(),
      'forum_id'   => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'ClassroomForumPost', 'column' => 'id', 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 100)),
      'content'    => new sfValidatorString(),
      'poster_id'  => new sfValidatorInteger(),
      'forum_id'   => new sfValidatorInteger(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('classroom_forum_post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomForumPost';
  }


}
