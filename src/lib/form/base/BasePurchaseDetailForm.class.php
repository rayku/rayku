<?php

/**
 * PurchaseDetail form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BasePurchaseDetailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'sales_id'         => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => true)),
      'transaction_id'   => new sfWidgetFormInput(),
      'full_name'        => new sfWidgetFormInput(),
      'email'            => new sfWidgetFormInput(),
      'address1'         => new sfWidgetFormInput(),
      'address2'         => new sfWidgetFormInput(),
      'city'             => new sfWidgetFormInput(),
      'state'            => new sfWidgetFormInput(),
      'country'          => new sfWidgetFormInput(),
      'telephone_number' => new sfWidgetFormInput(),
      'zip'              => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'PurchaseDetail', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'sales_id'         => new sfValidatorPropelChoice(array('model' => 'Sales', 'column' => 'id', 'required' => false)),
      'transaction_id'   => new sfValidatorInteger(array('required' => false)),
      'full_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address1'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address2'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'country'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'telephone_number' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'zip'              => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('purchase_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PurchaseDetail';
  }


}
