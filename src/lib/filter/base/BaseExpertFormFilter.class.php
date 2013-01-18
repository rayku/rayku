<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Expert filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'title'       => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'domain'      => new sfWidgetFormFilterInput(),
      'language'    => new sfWidgetFormFilterInput(),
      'onlinerate'  => new sfWidgetFormFilterInput(),
      'emailrate'   => new sfWidgetFormFilterInput(),
      'moc'         => new sfWidgetFormFilterInput(),
      'rating'      => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'title'       => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'domain'      => new sfValidatorPass(array('required' => false)),
      'language'    => new sfValidatorPass(array('required' => false)),
      'onlinerate'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'emailrate'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'moc'         => new sfValidatorPass(array('required' => false)),
      'rating'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('expert_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Expert';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'title'       => 'Text',
      'description' => 'Text',
      'domain'      => 'Text',
      'language'    => 'Text',
      'onlinerate'  => 'Number',
      'emailrate'   => 'Number',
      'moc'         => 'Text',
      'rating'      => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
