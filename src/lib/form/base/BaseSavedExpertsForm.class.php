<?php

/**
 * SavedExperts form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseSavedExpertsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'user_id'   => new sfWidgetFormInput(),
      'expert_id' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'SavedExperts', 'column' => 'id', 'required' => false)),
      'user_id'   => new sfValidatorInteger(),
      'expert_id' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('saved_experts[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SavedExperts';
  }


}
