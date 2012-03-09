<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * SavedExperts filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseSavedExpertsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'   => new sfWidgetFormFilterInput(),
      'expert_id' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('saved_experts_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SavedExperts';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'user_id'   => 'Number',
      'expert_id' => 'Number',
    );
  }
}
