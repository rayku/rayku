<?php

/**
 * Bulletin form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseBulletinForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'poster_id'  => new sfWidgetFormInput(),
      'content'    => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'Bulletin', 'column' => 'id', 'required' => false)),
      'poster_id'  => new sfValidatorInteger(array('required' => false)),
      'content'    => new sfValidatorString(array('required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bulletin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bulletin';
  }


}
