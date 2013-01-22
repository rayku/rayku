<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ShoppingCart filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseShoppingCartFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'item_id'               => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'user_id'               => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'quantity'              => new sfWidgetFormFilterInput(),
      'total_price'           => new sfWidgetFormFilterInput(),
      'total_shipping_charge' => new sfWidgetFormFilterInput(),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'is_active'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'item_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Item', 'column' => 'id')),
      'user_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'quantity'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_price'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'total_shipping_charge' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_active'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('shopping_cart_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShoppingCart';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'item_id'               => 'ForeignKey',
      'user_id'               => 'ForeignKey',
      'quantity'              => 'Number',
      'total_price'           => 'Number',
      'total_shipping_charge' => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'is_active'             => 'Number',
    );
  }
}
