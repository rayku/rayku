<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Item filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'size_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Size', 'add_empty' => true)),
      'item_type_id'             => new sfWidgetFormPropelChoice(array('model' => 'ItemType', 'add_empty' => true)),
      'title'                    => new sfWidgetFormFilterInput(),
      'description'              => new sfWidgetFormFilterInput(),
      'price_per_unit'           => new sfWidgetFormFilterInput(),
      'shipping_charge_per_unit' => new sfWidgetFormFilterInput(),
      'actual_value'             => new sfWidgetFormFilterInput(),
      'actual_value_currency'    => new sfWidgetFormFilterInput(),
      'quantity'                 => new sfWidgetFormFilterInput(),
      'image'                    => new sfWidgetFormFilterInput(),
      'features'                 => new sfWidgetFormFilterInput(),
      'is_active'                => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'size_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Size', 'column' => 'id')),
      'item_type_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ItemType', 'column' => 'id')),
      'title'                    => new sfValidatorPass(array('required' => false)),
      'description'              => new sfValidatorPass(array('required' => false)),
      'price_per_unit'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shipping_charge_per_unit' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'actual_value'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'actual_value_currency'    => new sfValidatorPass(array('required' => false)),
      'quantity'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'image'                    => new sfValidatorPass(array('required' => false)),
      'features'                 => new sfValidatorPass(array('required' => false)),
      'is_active'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'size_id'                  => 'ForeignKey',
      'item_type_id'             => 'ForeignKey',
      'title'                    => 'Text',
      'description'              => 'Text',
      'price_per_unit'           => 'Number',
      'shipping_charge_per_unit' => 'Number',
      'actual_value'             => 'Number',
      'actual_value_currency'    => 'Text',
      'quantity'                 => 'Number',
      'image'                    => 'Text',
      'features'                 => 'Text',
      'is_active'                => 'Number',
      'created_at'               => 'Date',
      'updated_at'               => 'Date',
    );
  }
}
