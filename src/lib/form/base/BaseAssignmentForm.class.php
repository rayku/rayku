<?php

/**
 * Assignment form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseAssignmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => false)),
      'title'        => new sfWidgetFormInput(),
      'description'  => new sfWidgetFormTextarea(),
      'format'       => new sfWidgetFormInput(),
      'attachments'  => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'due_date'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Assignment', 'column' => 'id', 'required' => false)),
      'classroom_id' => new sfValidatorPropelChoice(array('model' => 'Classroom', 'column' => 'id')),
      'title'        => new sfValidatorString(array('max_length' => 50)),
      'description'  => new sfValidatorString(),
      'format'       => new sfValidatorString(array('max_length' => 50)),
      'attachments'  => new sfValidatorString(array('max_length' => 100)),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'due_date'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('assignment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Assignment';
  }


}
