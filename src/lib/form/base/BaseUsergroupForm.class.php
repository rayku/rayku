<?php

/**
 * Usergroup form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUsergroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInput(),
      'points'         => new sfWidgetFormInput(),
      'description'    => new sfWidgetFormTextarea(),
      'type'           => new sfWidgetFormInput(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'bankrupt_since' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Usergroup', 'column' => 'id', 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'points'         => new sfValidatorInteger(array('required' => false)),
      'description'    => new sfValidatorString(array('required' => false)),
      'type'           => new sfValidatorInteger(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'bankrupt_since' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('usergroup[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usergroup';
  }


}
