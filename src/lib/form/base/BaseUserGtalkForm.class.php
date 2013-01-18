<?php

/**
 * UserGtalk form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserGtalkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'  => new sfWidgetFormInputHidden(),
      'gtalkid' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'userid'  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'gtalkid' => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('user_gtalk[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserGtalk';
  }


}
