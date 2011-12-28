<?php

/**
 * BlogAttachments form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseBlogAttachmentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'classroom_blog_id' => new sfWidgetFormPropelChoice(array('model' => 'ClassroomBlog', 'add_empty' => false)),
      'file'              => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorPropelChoice(array('model' => 'BlogAttachments', 'column' => 'id', 'required' => false)),
      'classroom_blog_id' => new sfValidatorPropelChoice(array('model' => 'ClassroomBlog', 'column' => 'id')),
      'file'              => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('blog_attachments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogAttachments';
  }


}
