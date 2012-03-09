<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Friend filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseFriendFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id1'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'user_id2'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'status'     => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id1'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'user_id2'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'status'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('friend_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Friend';
  }

  public function getFields()
  {
    return array(
      'user_id1'   => 'ForeignKey',
      'user_id2'   => 'ForeignKey',
      'status'     => 'Number',
      'created_at' => 'Date',
      'id'         => 'Number',
    );
  }
}
