<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SalesDetail filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseSalesDetailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'item_id'               => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'total_price'           => new sfWidgetFormFilterInput(),
      'total_shipping_charge' => new sfWidgetFormFilterInput(),
      'quantity'              => new sfWidgetFormFilterInput(),
      'transaction_id'        => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'item_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Item', 'column' => 'id')),
      'total_price'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_shipping_charge' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quantity'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'transaction_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sales_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SalesDetail';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'item_id'               => 'ForeignKey',
      'total_price'           => 'Number',
      'total_shipping_charge' => 'Number',
      'quantity'              => 'Number',
      'transaction_id'        => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
