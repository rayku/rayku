<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Shout filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseShoutFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'poster_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'recipient_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'content'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poster_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'recipient_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'content'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('shout_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Shout';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'poster_id'    => 'ForeignKey',
      'recipient_id' => 'ForeignKey',
      'created_at'   => 'Date',
      'content'      => 'Text',
    );
  }
}
