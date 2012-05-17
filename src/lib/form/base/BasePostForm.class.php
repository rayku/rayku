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
      'reported'      => new sfWidgetFormInput(),
      'user_ip'       => new sfWidgetFormInput(),
      'banned'        => new sfWidgetFormInput(),
      'reported_date' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Post', 'column' => 'id', 'required' => false)),
      'poster_id'     => new sfValidatorInteger(),
      'thread_id'     => new sfValidatorInteger(),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'content'       => new sfValidatorString(),
      'best_response' => new sfValidatorInteger(),
      'reported'      => new sfValidatorInteger(),
      'user_ip'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'banned'        => new sfValidatorInteger(),
      'reported_date' => new sfValidatorDateTime(array('required' => false)),
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
