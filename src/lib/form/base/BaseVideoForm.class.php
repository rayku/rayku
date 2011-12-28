<?php

/**
 * Video form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseVideoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'owner_id'    => new sfWidgetFormInput(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'type'        => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Video', 'column' => 'id', 'required' => false)),
      'owner_id'    => new sfValidatorInteger(array('required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'type'        => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('video[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Video';
  }


}
