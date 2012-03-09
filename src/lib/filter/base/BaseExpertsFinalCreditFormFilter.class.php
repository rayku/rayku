<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertsFinalCredit filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertsFinalCreditFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'expert_id' => new sfWidgetFormFilterInput(),
      'amount'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'expert_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('experts_final_credit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsFinalCredit';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'expert_id' => 'Number',
      'amount'    => 'Number',
    );
  }
}
