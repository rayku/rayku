<?php

/**
 * Network form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseNetworkForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'type'        => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Network', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'type'        => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('network[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Network';
  }


}
