<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertsDebitDetails filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertsDebitDetailsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'expert_id' => new sfWidgetFormFilterInput(),
      'amount'    => new sfWidgetFormFilterInput(),
      'time'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'expert_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'time'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('experts_debit_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsDebitDetails';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'expert_id' => 'Number',
      'amount'    => 'Number',
      'time'      => 'Date',
    );
  }
}
