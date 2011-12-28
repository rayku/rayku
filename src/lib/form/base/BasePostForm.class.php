<?php

/**
 * Post form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BasePostForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'poster_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'thread_id'     => new sfWidgetFormPropelChoice(array('model' => 'Thread', 'add_empty' => true)),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'content'       => new sfWidgetFormTextarea(),
      'best_response' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id', 'required' => false)),
      'poster_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'thread_id'     => new sfValidatorPropelChoice(array('model' => 'Thread', 'column' => 'id', 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
      'content'       => new sfValidatorString(array('required' => false)),
      'best_response' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('post[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }


}
