<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Subscription filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseSubscriptionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'notification_type' => new sfWidgetFormFilterInput(),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'teacher_id'        => new sfWidgetFormFilterInput(),
      'classroom_id'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'notification_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'teacher_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'classroom_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('subscription_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Subscription';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'notification_type' => 'Number',
      'user_id'           => 'ForeignKey',
      'teacher_id'        => 'Number',
      'classroom_id'      => 'Number',
    );
  }
}
