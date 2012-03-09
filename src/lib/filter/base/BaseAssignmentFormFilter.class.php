<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Assignment filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseAssignmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => true)),
      'title'        => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'format'       => new sfWidgetFormFilterInput(),
      'attachments'  => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'due_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'classroom_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Classroom', 'column' => 'id')),
      'title'        => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'format'       => new sfValidatorPass(array('required' => false)),
      'attachments'  => new sfValidatorPass(array('required' => false)),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'due_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('assignment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Assignment';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'classroom_id' => 'ForeignKey',
      'title'        => 'Text',
      'description'  => 'Text',
      'format'       => 'Text',
      'attachments'  => 'Text',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'due_date'     => 'Date',
    );
  }
}
