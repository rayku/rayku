<?php

/**
 * Album form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseAlbumForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'owner_id'    => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Album', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'owner_id'    => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('album[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Album';
  }


}
