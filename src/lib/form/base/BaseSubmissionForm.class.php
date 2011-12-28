<?php

/**
 * Submission form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseSubmissionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'assignment_id' => new sfWidgetFormPropelChoice(array('model' => 'Assignment', 'add_empty' => false)),
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'data'          => new sfWidgetFormTextarea(),
      'grade'         => new sfWidgetFormInput(),
      'comment'       => new sfWidgetFormTextarea(),
      'approved'      => new sfWidgetFormInput(),
      'path'          => new sfWidgetFormInput(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Submission', 'column' => 'id', 'required' => false)),
      'assignment_id' => new sfValidatorPropelChoice(array('model' => 'Assignment', 'column' => 'id')),
      'user_id'       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'data'          => new sfValidatorString(),
      'grade'         => new sfValidatorString(array('max_length' => 10)),
      'comment'       => new sfValidatorString(),
      'approved'      => new sfValidatorInteger(),
      'path'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('submission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Submission';
  }


}
