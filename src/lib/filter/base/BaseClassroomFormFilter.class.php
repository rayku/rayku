<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Classroom filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseClassroomFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'category_id'      => new sfWidgetFormFilterInput(),
      'classroom_banner' => new sfWidgetFormFilterInput(),
      'fullname'         => new sfWidgetFormFilterInput(),
      'shortname'        => new sfWidgetFormFilterInput(),
      'class_username'   => new sfWidgetFormFilterInput(),
      'email_passcode'   => new sfWidgetFormFilterInput(),
      'classroom_email'  => new sfWidgetFormFilterInput(),
      'live_webcam'      => new sfWidgetFormFilterInput(),
      'email_updateblog' => new sfWidgetFormFilterInput(),
      'school_name'      => new sfWidgetFormFilterInput(),
      'location'         => new sfWidgetFormFilterInput(),
      'idnumber'         => new sfWidgetFormFilterInput(),
      'summary'          => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'category_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'classroom_banner' => new sfValidatorPass(array('required' => false)),
      'fullname'         => new sfValidatorPass(array('required' => false)),
      'shortname'        => new sfValidatorPass(array('required' => false)),
      'class_username'   => new sfValidatorPass(array('required' => false)),
      'email_passcode'   => new sfValidatorPass(array('required' => false)),
      'classroom_email'  => new sfValidatorPass(array('required' => false)),
      'live_webcam'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'email_updateblog' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'school_name'      => new sfValidatorPass(array('required' => false)),
      'location'         => new sfValidatorPass(array('required' => false)),
      'idnumber'         => new sfValidatorPass(array('required' => false)),
      'summary'          => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('classroom_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Classroom';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'category_id'      => 'Number',
      'classroom_banner' => 'Text',
      'fullname'         => 'Text',
      'shortname'        => 'Text',
      'class_username'   => 'Text',
      'email_passcode'   => 'Text',
      'classroom_email'  => 'Text',
      'live_webcam'      => 'Number',
      'email_updateblog' => 'Number',
      'school_name'      => 'Text',
      'location'         => 'Text',
      'idnumber'         => 'Text',
      'summary'          => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
