<?php

/**
 * ForumAnswer form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseForumAnswerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'answer'            => new sfWidgetFormTextarea(),
      'forum_question_id' => new sfWidgetFormInput(),
      'user_id'           => new sfWidgetFormInput(),
      'best_response'     => new sfWidgetFormInput(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'ForumAnswer', 'column' => 'id', 'required' => false)),
      'answer'            => new sfValidatorString(),
      'forum_question_id' => new sfValidatorInteger(),
      'user_id'           => new sfValidatorInteger(),
      'best_response'     => new sfValidatorInteger(),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('forum_answer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumAnswer';
  }


}
