<?php

/**
 * UserGift form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserGiftForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'gift_id'    => new sfWidgetFormPropelChoice(array('model' => 'Gift', 'add_empty' => true)),
      'giver_id'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at' => new sfWidgetFormDateTime(),
      'message'    => new sfWidgetFormTextarea(),
      'type'       => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'UserGift', 'column' => 'id', 'required' => false)),
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'gift_id'    => new sfValidatorPropelChoice(array('model' => 'Gift', 'column' => 'id', 'required' => false)),
      'giver_id'   => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'message'    => new sfValidatorString(array('required' => false)),
      'type'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_gift[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserGift';
  }


}
