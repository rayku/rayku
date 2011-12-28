<?php

/**
 * ClassroomMembers form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomMembersForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'category_id'  => new sfWidgetFormInput(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => false)),
      'approved'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'ClassroomMembers', 'column' => 'id', 'required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'category_id'  => new sfValidatorInteger(),
      'classroom_id' => new sfValidatorPropelChoice(array('model' => 'Classroom', 'column' => 'id')),
      'approved'     => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('classroom_members[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomMembers';
  }


}
