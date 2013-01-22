<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PurchaseDetail filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BasePurchaseDetailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'sales_id'         => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => true)),
      'transaction_id'   => new sfWidgetFormFilterInput(),
      'full_name'        => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'address1'         => new sfWidgetFormFilterInput(),
      'address2'         => new sfWidgetFormFilterInput(),
      'city'             => new sfWidgetFormFilterInput(),
      'state'            => new sfWidgetFormFilterInput(),
      'country'          => new sfWidgetFormFilterInput(),
      'telephone_number' => new sfWidgetFormFilterInput(),
      'zip'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'sales_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sales', 'column' => 'id')),
      'transaction_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'full_name'        => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'address1'         => new sfValidatorPass(array('required' => false)),
      'address2'         => new sfValidatorPass(array('required' => false)),
      'city'             => new sfValidatorPass(array('required' => false)),
      'state'            => new sfValidatorPass(array('required' => false)),
      'country'          => new sfValidatorPass(array('required' => false)),
      'telephone_number' => new sfValidatorPass(array('required' => false)),
      'zip'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('purchase_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PurchaseDetail';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'sales_id'         => 'ForeignKey',
      'transaction_id'   => 'Number',
      'full_name'        => 'Text',
      'email'            => 'Text',
      'address1'         => 'Text',
      'address2'         => 'Text',
      'city'             => 'Text',
      'state'            => 'Text',
      'country'          => 'Text',
      'telephone_number' => 'Text',
      'zip'              => 'Text',
    );
  }
}
