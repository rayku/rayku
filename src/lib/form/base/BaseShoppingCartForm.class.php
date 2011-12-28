<?php

/**
 * ShoppingCart form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseShoppingCartForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'item_id'               => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'user_id'               => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'quantity'              => new sfWidgetFormInput(),
      'total_price'           => new sfWidgetFormInput(),
      'total_shipping_charge' => new sfWidgetFormInput(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
      'is_active'             => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'ShoppingCart', 'column' => 'id', 'required' => false)),
      'item_id'               => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id', 'required' => false)),
      'user_id'               => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'quantity'              => new sfValidatorInteger(array('required' => false)),
      'total_price'           => new sfValidatorInteger(array('required' => false)),
      'total_shipping_charge' => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(array('required' => false)),
      'updated_at'            => new sfValidatorDateTime(array('required' => false)),
      'is_active'             => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shopping_cart[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ShoppingCart';
  }


}
