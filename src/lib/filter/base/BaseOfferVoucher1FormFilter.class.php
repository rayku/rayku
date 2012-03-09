<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * OfferVoucher1 filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseOfferVoucher1FormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'         => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'code'            => new sfWidgetFormFilterInput(),
      'valid_till_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'is_used'         => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'is_active'       => new sfWidgetFormFilterInput(),
      'price'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'code'            => new sfValidatorPass(array('required' => false)),
      'valid_till_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_used'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_active'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('offer_voucher1_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'OfferVoucher1';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'user_id'         => 'ForeignKey',
      'code'            => 'Text',
      'valid_till_date' => 'Date',
      'is_used'         => 'Number',
      'created_at'      => 'Date',
      'is_active'       => 'Number',
      'price'           => 'Number',
    );
  }
}
