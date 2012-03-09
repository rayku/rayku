<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserGift filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserGiftFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'gift_id'    => new sfWidgetFormPropelChoice(array('model' => 'Gift', 'add_empty' => true)),
      'giver_id'   => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'message'    => new sfWidgetFormFilterInput(),
      'type'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'gift_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Gift', 'column' => 'id')),
      'giver_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'message'    => new sfValidatorPass(array('required' => false)),
      'type'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('user_gift_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserGift';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'user_id'    => 'ForeignKey',
      'gift_id'    => 'ForeignKey',
      'giver_id'   => 'ForeignKey',
      'created_at' => 'Date',
      'message'    => 'Text',
      'type'       => 'Number',
    );
  }
}
