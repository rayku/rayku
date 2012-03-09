<?php

/**
 * ExpertsPromoText form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertsPromoTextForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'exp_id'  => new sfWidgetFormInput(),
      'content' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'ExpertsPromoText', 'column' => 'id', 'required' => false)),
      'exp_id'  => new sfValidatorInteger(),
      'content' => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('experts_promo_text[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsPromoText';
  }


}
