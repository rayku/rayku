<?php

/**
 * GalleryAcl form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseGalleryAclForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'gallery_id' => new sfWidgetFormInput(),
      'user_id'    => new sfWidgetFormInput(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'gallery_id' => new sfValidatorInteger(array('required' => false)),
      'user_id'    => new sfValidatorInteger(array('required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'GalleryAcl', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('gallery_acl[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GalleryAcl';
  }


}
