<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Post filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BasePostFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'poster_id'     => new sfWidgetFormFilterInput(),
      'thread_id'     => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'content'       => new sfWidgetFormFilterInput(),
      'best_response' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poster_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thread_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'content'       => new sfValidatorPass(array('required' => false)),
      'best_response' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('post_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Post';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'poster_id'     => 'Number',
      'thread_id'     => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'content'       => 'Text',
      'best_response' => 'Number',
    );
  }
}
