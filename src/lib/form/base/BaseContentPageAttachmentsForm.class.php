<?php

/**
 * ContentPageAttachments form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseContentPageAttachmentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'content_page_id' => new sfWidgetFormInput(),
      'file'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'ContentPageAttachments', 'column' => 'id', 'required' => false)),
      'content_page_id' => new sfValidatorInteger(),
      'file'            => new sfValidatorString(array('max_length' => 100)),
    ));

    $this->widgetSchema->setNameFormat('content_page_attachments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentPageAttachments';
  }


}
