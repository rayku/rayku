<?php

/**
 * Classroom form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'category_id'      => new sfWidgetFormInput(),
      'classroom_banner' => new sfWidgetFormInput(),
      'fullname'         => new sfWidgetFormInput(),
      'shortname'        => new sfWidgetFormInput(),
      'class_username'   => new sfWidgetFormInput(),
      'email_passcode'   => new sfWidgetFormInput(),
      'classroom_email'  => new sfWidgetFormInput(),
      'live_webcam'      => new sfWidgetFormInput(),
      'email_updateblog' => new sfWidgetFormInput(),
      'school_name'      => new sfWidgetFormInput(),
      'location'         => new sfWidgetFormInput(),
      'idnumber'         => new sfWidgetFormInput(),
      'summary'          => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Classroom', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'category_id'      => new sfValidatorInteger(),
      'classroom_banner' => new sfValidatorString(array('max_length' => 50)),
      'fullname'         => new sfValidatorString(array('max_length' => 50)),
      'shortname'        => new sfValidatorString(array('max_length' => 50)),
      'class_username'   => new sfValidatorString(array('max_length' => 100)),
      'email_passcode'   => new sfValidatorString(array('max_length' => 100)),
      'classroom_email'  => new sfValidatorString(array('max_length' => 100)),
      'live_webcam'      => new sfValidatorInteger(),
      'email_updateblog' => new sfValidatorInteger(),
      'school_name'      => new sfValidatorString(array('max_length' => 100)),
      'location'         => new sfValidatorString(array('max_length' => 100)),
      'idnumber'         => new sfValidatorString(array('max_length' => 50)),
      'summary'          => new sfValidatorString(),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Classroom', 'column' => array('shortname')))
    );

    $this->widgetSchema->setNameFormat('classroom[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Classroom';
  }


}
