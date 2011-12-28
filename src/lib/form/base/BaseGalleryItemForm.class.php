<?php

/**
 * GalleryItem form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseGalleryItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInput(),
      'gallery_id'       => new sfWidgetFormPropelChoice(array('model' => 'Gallery', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'file_name'        => new sfWidgetFormInput(),
      'file_system_path' => new sfWidgetFormInput(),
      'mime_type'        => new sfWidgetFormInput(),
      'is_image'         => new sfWidgetFormInput(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'GalleryItem', 'column' => 'id', 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'gallery_id'       => new sfValidatorPropelChoice(array('model' => 'Gallery', 'column' => 'id', 'required' => false)),
      'user_id'          => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'file_name'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'file_system_path' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mime_type'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'is_image'         => new sfValidatorInteger(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gallery_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GalleryItem';
  }


}
