<?php

/**
 * ForumQuestion form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseForumQuestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'question'    => new sfWidgetFormTextarea(),
      'category_id' => new sfWidgetFormInput(),
      'user_id'     => new sfWidgetFormInput(),
      'visible'     => new sfWidgetFormInput(),
      'cancel'      => new sfWidgetFormInput(),
      'notify'      => new sfWidgetFormInput(),
      'tags'        => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'ForumQuestion', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 100)),
      'question'    => new sfValidatorString(),
      'category_id' => new sfValidatorInteger(),
      'user_id'     => new sfValidatorInteger(),
      'visible'     => new sfValidatorInteger(),
      'cancel'      => new sfValidatorInteger(),
      'notify'      => new sfValidatorInteger(),
      'tags'        => new sfValidatorString(array('max_length' => 100)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('forum_question[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumQuestion';
  }


}
