<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertAvailableDays filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertAvailableDaysFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'expert_id' => new sfWidgetFormFilterInput(),
      'monday'    => new sfWidgetFormFilterInput(),
      'tuesday'   => new sfWidgetFormFilterInput(),
      'wednesday' => new sfWidgetFormFilterInput(),
      'thursday'  => new sfWidgetFormFilterInput(),
      'friday'    => new sfWidgetFormFilterInput(),
      'saturday'  => new sfWidgetFormFilterInput(),
      'sunday'    => new sfWidgetFormFilterInput(),
      'timings'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'expert_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'monday'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tuesday'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'wednesday' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thursday'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'friday'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'saturday'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sunday'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'timings'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('expert_available_days_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertAvailableDays';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'expert_id' => 'Number',
      'monday'    => 'Number',
      'tuesday'   => 'Number',
      'wednesday' => 'Number',
      'thursday'  => 'Number',
      'friday'    => 'Number',
      'saturday'  => 'Number',
      'sunday'    => 'Number',
      'timings'   => 'Text',
    );
  }
}
