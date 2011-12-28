<?php

/**
 * Item form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'size_id'                  => new sfWidgetFormPropelChoice(array('model' => 'Size', 'add_empty' => true)),
      'item_type_id'             => new sfWidgetFormPropelChoice(array('model' => 'ItemType', 'add_empty' => true)),
      'title'                    => new sfWidgetFormInput(),
      'description'              => new sfWidgetFormTextarea(),
      'price_per_unit'           => new sfWidgetFormInput(),
      'shipping_charge_per_unit' => new sfWidgetFormInput(),
      'actual_value'             => new sfWidgetFormInput(),
      'actual_value_currency'    => new sfWidgetFormInput(),
      'quantity'                 => new sfWidgetFormInput(),
      'image'                    => new sfWidgetFormInput(),
      'features'                 => new sfWidgetFormTextarea(),
      'is_active'                => new sfWidgetFormInput(),
      'created_at'               => new sfWidgetFormDateTime(),
      'updated_at'               => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id', 'required' => false)),
      'size_id'                  => new sfValidatorPropelChoice(array('model' => 'Size', 'column' => 'id', 'required' => false)),
      'item_type_id'             => new sfValidatorPropelChoice(array('model' => 'ItemType', 'column' => 'id', 'required' => false)),
      'title'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'              => new sfValidatorString(array('required' => false)),
      'price_per_unit'           => new sfValidatorInteger(array('required' => false)),
      'shipping_charge_per_unit' => new sfValidatorInteger(array('required' => false)),
      'actual_value'             => new sfValidatorInteger(array('required' => false)),
      'actual_value_currency'    => new sfValidatorString(array('max_length' => 5, 'required' => false)),
      'quantity'                 => new sfValidatorInteger(array('required' => false)),
      'image'                    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'features'                 => new sfValidatorString(array('required' => false)),
      'is_active'                => new sfValidatorInteger(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(array('required' => false)),
      'updated_at'               => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }


}
