<?php

/**
 * UserDonations form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserDonationsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'from_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'points'       => new sfWidgetFormInput(),
      'comments'     => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'UserDonations', 'column' => 'id', 'required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'from_user_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'points'       => new sfValidatorInteger(array('required' => false)),
      'comments'     => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_donations[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserDonations';
  }


}
