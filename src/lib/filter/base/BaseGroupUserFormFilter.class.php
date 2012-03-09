<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * GroupUser filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseGroupUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'   => new sfWidgetFormFilterInput(),
      'inviter_id' => new sfWidgetFormFilterInput(),
      'user_id'    => new sfWidgetFormFilterInput(),
      'status'     => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'group_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'inviter_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('group_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupUser';
  }

  public function getFields()
  {
    return array(
      'group_id'   => 'Number',
      'inviter_id' => 'Number',
      'user_id'    => 'Number',
      'status'     => 'Number',
      'created_at' => 'Date',
      'id'         => 'Number',
    );
  }
}
