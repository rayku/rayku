<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * StudentVoice filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseStudentVoiceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'title'        => new sfWidgetFormFilterInput(),
      'description'  => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormFilterInput(),
      'vote'         => new sfWidgetFormFilterInput(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => true)),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'title'        => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'vote'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'classroom_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Classroom', 'column' => 'id')),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('student_voice_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentVoice';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_id'      => 'ForeignKey',
      'title'        => 'Text',
      'description'  => 'Text',
      'status'       => 'Number',
      'vote'         => 'Number',
      'classroom_id' => 'ForeignKey',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
    );
  }
}
