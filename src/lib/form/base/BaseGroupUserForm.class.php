<?php

/**
 * GroupUser form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseGroupUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'   => new sfWidgetFormInput(),
      'inviter_id' => new sfWidgetFormInput(),
      'user_id'    => new sfWidgetFormInput(),
      'status'     => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id'   => new sfValidatorInteger(array('required' => false)),
      'inviter_id' => new sfValidatorInteger(array('required' => false)),
      'user_id'    => new sfValidatorInteger(array('required' => false)),
      'status'     => new sfValidatorInteger(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'GroupUser', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('group_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupUser';
  }


}
