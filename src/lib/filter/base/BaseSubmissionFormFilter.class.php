<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Submission filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseSubmissionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'assignment_id' => new sfWidgetFormPropelChoice(array('model' => 'Assignment', 'add_empty' => true)),
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'data'          => new sfWidgetFormFilterInput(),
      'grade'         => new sfWidgetFormFilterInput(),
      'comment'       => new sfWidgetFormFilterInput(),
      'approved'      => new sfWidgetFormFilterInput(),
      'path'          => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'assignment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Assignment', 'column' => 'id')),
      'user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'data'          => new sfValidatorPass(array('required' => false)),
      'grade'         => new sfValidatorPass(array('required' => false)),
      'comment'       => new sfValidatorPass(array('required' => false)),
      'approved'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'path'          => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('submission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Submission';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'assignment_id' => 'ForeignKey',
      'user_id'       => 'ForeignKey',
      'data'          => 'Text',
      'grade'         => 'Text',
      'comment'       => 'Text',
      'approved'      => 'Number',
      'path'          => 'Text',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
