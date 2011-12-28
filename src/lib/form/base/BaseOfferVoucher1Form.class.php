<?php

/**
 * OfferVoucher1 form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseOfferVoucher1Form extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'code'            => new sfWidgetFormInput(),
      'valid_till_date' => new sfWidgetFormDate(),
      'is_used'         => new sfWidgetFormInput(),
      'created_at'      => new sfWidgetFormDateTime(),
      'is_active'       => new sfWidgetFormInput(),
      'price'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'OfferVoucher1', 'column' => 'id', 'required' => false)),
      'user_id'         => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'code'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'valid_till_date' => new sfValidatorDate(array('required' => false)),
      'is_used'         => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'is_active'       => new sfValidatorInteger(array('required' => false)),
      'price'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('offer_voucher1[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OfferVoucher1';
  }


}
