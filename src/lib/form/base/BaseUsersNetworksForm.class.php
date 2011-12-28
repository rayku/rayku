<?php

/**
 * UsersNetworks form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUsersNetworksForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'network_id' => new sfWidgetFormInput(),
      'user_id'    => new sfWidgetFormInput(),
      'joined_on'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'UsersNetworks', 'column' => 'id', 'required' => false)),
      'network_id' => new sfValidatorInteger(),
      'user_id'    => new sfValidatorInteger(),
      'joined_on'  => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('users_networks[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UsersNetworks';
  }


}
