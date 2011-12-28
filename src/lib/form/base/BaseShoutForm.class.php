<?php

/**
 * Shout form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseShoutForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'poster_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'recipient_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'content'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Shout', 'column' => 'id', 'required' => false)),
      'poster_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'recipient_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'content'      => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shout[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shout';
  }


}
