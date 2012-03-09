<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertsAdminPayout filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertsAdminPayoutFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'expert_id' => new sfWidgetFormFilterInput(),
      'amount'    => new sfWidgetFormFilterInput(),
      'paypal_id' => new sfWidgetFormFilterInput(),
      'paid'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'expert_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'paypal_id' => new sfValidatorPass(array('required' => false)),
      'paid'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('experts_admin_payout_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsAdminPayout';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'expert_id' => 'Number',
      'amount'    => 'Number',
      'paypal_id' => 'Text',
      'paid'      => 'Number',
    );
  }
}
