<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * BlogAttachments filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseBlogAttachmentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'classroom_blog_id' => new sfWidgetFormPropelChoice(array('model' => 'ClassroomBlog', 'add_empty' => true)),
      'file'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'classroom_blog_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ClassroomBlog', 'column' => 'id')),
      'file'              => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('blog_attachments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BlogAttachments';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'classroom_blog_id' => 'ForeignKey',
      'file'              => 'Text',
    );
  }
}
