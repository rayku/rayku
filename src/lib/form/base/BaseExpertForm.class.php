<?php

/**
 * Expert form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'title'       => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'domain'      => new sfWidgetFormInput(),
      'language'    => new sfWidgetFormInput(),
      'onlinerate'  => new sfWidgetFormInput(),
      'emailrate'   => new sfWidgetFormInput(),
      'moc'         => new sfWidgetFormInput(),
      'rating'      => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Expert', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'title'       => new sfValidatorString(array('max_length' => 100)),
      'description' => new sfValidatorString(),
      'domain'      => new sfValidatorString(array('max_length' => 100)),
      'language'    => new sfValidatorString(array('max_length' => 100)),
      'onlinerate'  => new sfValidatorNumber(array('required' => false)),
      'emailrate'   => new sfValidatorNumber(array('required' => false)),
      'moc'         => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'rating'      => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('expert[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Expert';
  }


}
