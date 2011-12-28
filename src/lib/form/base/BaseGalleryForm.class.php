<?php

/**
 * Gallery form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseGalleryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInput(),
      'show_entity'  => new sfWidgetFormInput(),
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Gallery', 'column' => 'id', 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'show_entity'  => new sfValidatorInteger(array('required' => false)),
      'user_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
      'classroom_id' => new sfValidatorPropelChoice(array('model' => 'Classroom', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gallery[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gallery';
  }


}
