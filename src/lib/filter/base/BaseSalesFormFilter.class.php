<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Sales filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseSalesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'offer_voucher_id'      => new sfWidgetFormPropelChoice(array('model' => 'OfferVoucher1', 'add_empty' => true)),
      'status_id'             => new sfWidgetFormPropelChoice(array('model' => 'Status', 'add_empty' => true)),
      'total_sale_price'      => new sfWidgetFormFilterInput(),
      'total_shipping_charge' => new sfWidgetFormFilterInput(),
      'quantity'              => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'total_item_price'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'offer_voucher_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'OfferVoucher1', 'column' => 'id')),
      'status_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Status', 'column' => 'id')),
      'total_sale_price'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_shipping_charge' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quantity'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'total_item_price'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sales_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sales';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'offer_voucher_id'      => 'ForeignKey',
      'status_id'             => 'ForeignKey',
      'total_sale_price'      => 'Number',
      'total_shipping_charge' => 'Number',
      'quantity'              => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'total_item_price'      => 'Number',
    );
  }
}
