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
      'poster_id'     => new sfWidgetFormInput(),
      'thread_id'     => new sfWidgetFormInput(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'content'       => new sfWidgetFormTextarea(),
      'best_response' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id', 'required' => false)),
      'poster_id'     => new sfValidatorInteger(),
      'thread_id'     => new sfValidatorInteger(),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'content'       => new sfValidatorString(),
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
