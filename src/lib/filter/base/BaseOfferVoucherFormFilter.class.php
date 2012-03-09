<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * OfferVoucher filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseOfferVoucherFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'            => new sfWidgetFormFilterInput(),
      'valid_till_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_used'         => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'is_active'       => new sfWidgetFormFilterInput(),
      'price'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'            => new sfValidatorPass(array('required' => false)),
      'valid_till_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_used'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_active'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('offer_voucher_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OfferVoucher';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'code'            => 'Text',
      'valid_till_date' => 'Date',
      'is_used'         => 'Number',
      'created_at'      => 'Date',
      'is_active'       => 'Number',
      'price'           => 'Number',
    );
  }
}
