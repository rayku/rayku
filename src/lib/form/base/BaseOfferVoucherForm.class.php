<?php

/**
 * OfferVoucher form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseOfferVoucherForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'code'            => new sfWidgetFormInput(),
      'valid_till_date' => new sfWidgetFormDate(),
      'is_used'         => new sfWidgetFormInput(),
      'created_at'      => new sfWidgetFormDateTime(),
      'is_active'       => new sfWidgetFormInput(),
      'price'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'OfferVoucher', 'column' => 'id', 'required' => false)),
      'code'            => new sfValidatorString(array('max_length' => 100)),
      'valid_till_date' => new sfValidatorDate(),
      'is_used'         => new sfValidatorInteger(),
      'created_at'      => new sfValidatorDateTime(),
      'is_active'       => new sfValidatorInteger(),
      'price'           => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('offer_voucher[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OfferVoucher';
  }


}
