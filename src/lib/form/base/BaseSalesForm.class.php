<?php

/**
 * Sales form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseSalesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'offer_voucher_id'      => new sfWidgetFormPropelChoice(array('model' => 'OfferVoucher1', 'add_empty' => true)),
      'status_id'             => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'total_sale_price'      => new sfWidgetFormInput(),
      'total_shipping_charge' => new sfWidgetFormInput(),
      'quantity'              => new sfWidgetFormInput(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'total_item_price'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'Sales', 'column' => 'id', 'required' => false)),
      'offer_voucher_id'      => new sfValidatorPropelChoice(array('model' => 'OfferVoucher1', 'column' => 'id', 'required' => false)),
      'status_id'             => new sfValidatorPropelChoice(array('model' => 'Status', 'column' => 'id', 'required' => false)),
      'total_sale_price'      => new sfValidatorInteger(array('required' => false)),
      'total_shipping_charge' => new sfValidatorInteger(array('required' => false)),
      'quantity'              => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(array('required' => false)),
      'updated_at'            => new sfValidatorDateTime(array('required' => false)),
      'total_item_price'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sales[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sales';
  }


}
