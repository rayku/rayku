<?php

/**
 * ClassroomForumComment form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomForumCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'thread_id'    => new sfWidgetFormInput(),
      'commentor_id' => new sfWidgetFormInput(),
      'content'      => new sfWidgetFormTextarea(),
      'approved'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'ClassroomForumComment', 'column' => 'id', 'required' => false)),
      'thread_id'    => new sfValidatorInteger(),
      'commentor_id' => new sfValidatorInteger(),
      'content'      => new sfValidatorString(),
      'approved'     => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('classroom_forum_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomForumComment';
  }


}
