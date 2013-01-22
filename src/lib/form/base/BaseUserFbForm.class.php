<?php

/**
 * UserFb form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserFbForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'userid'      => new sfWidgetFormInputHidden(),
      'fb_username' => new sfWidgetFormInput(),
      'fb_uid'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'userid'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'fb_username' => new sfValidatorString(array('max_length' => 255)),
      'fb_uid'      => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('user_fb[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserFb';
  }


}
