<?php

/**
 * Gift form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseGiftForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'image'       => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'cost'        => new sfWidgetFormInput(),
      'hidden'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Gift', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'image'       => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'cost'        => new sfValidatorInteger(array('required' => false)),
      'hidden'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gift[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gift';
  }


}
