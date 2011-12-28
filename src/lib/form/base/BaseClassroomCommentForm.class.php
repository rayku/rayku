<?php

/**
 * ClassroomComment form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'classroom_blog_id' => new sfWidgetFormPropelChoice(array('model' => 'ClassroomBlog', 'add_empty' => false)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'content'           => new sfWidgetFormTextarea(),
      'posted_at'         => new sfWidgetFormDateTime(),
      'approved'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'ClassroomComment', 'column' => 'id', 'required' => false)),
      'classroom_blog_id' => new sfValidatorPropelChoice(array('model' => 'ClassroomBlog', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'content'           => new sfValidatorString(),
      'posted_at'         => new sfValidatorDateTime(),
      'approved'          => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('classroom_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomComment';
  }


}
