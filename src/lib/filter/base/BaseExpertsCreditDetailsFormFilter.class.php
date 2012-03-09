<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertsCreditDetails filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertsCreditDetailsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'student_id'          => new sfWidgetFormFilterInput(),
      'expert_id'           => new sfWidgetFormFilterInput(),
      'credit_amount'       => new sfWidgetFormFilterInput(),
      'lesson_id'           => new sfWidgetFormFilterInput(),
      'immediate_lesson_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'student_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'credit_amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'lesson_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'immediate_lesson_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('experts_credit_details_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsCreditDetails';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'student_id'          => 'Number',
      'expert_id'           => 'Number',
      'credit_amount'       => 'Number',
      'lesson_id'           => 'Number',
      'immediate_lesson_id' => 'Number',
    );
  }
}
