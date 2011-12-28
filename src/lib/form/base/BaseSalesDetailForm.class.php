<?php

/**
 * SalesDetail form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseSalesDetailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'item_id'               => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'total_price'           => new sfWidgetFormInput(),
      'total_shipping_charge' => new sfWidgetFormInput(),
      'quantity'              => new sfWidgetFormInput(),
      'transaction_id'        => new sfWidgetFormInput(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorPropelChoice(array('model' => 'SalesDetail', 'column' => 'id', 'required' => false)),
      'item_id'               => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id', 'required' => false)),
      'total_price'           => new sfValidatorInteger(array('required' => false)),
      'total_shipping_charge' => new sfValidatorInteger(array('required' => false)),
      'quantity'              => new sfValidatorInteger(array('required' => false)),
      'transaction_id'        => new sfValidatorInteger(array('required' => false)),
      'created_at'            => new sfValidatorDateTime(array('required' => false)),
      'updated_at'            => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sales_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SalesDetail';
  }


}
