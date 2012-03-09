<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ContentPageAttachments filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseContentPageAttachmentsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'content_page_id' => new sfWidgetFormFilterInput(),
      'file'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'content_page_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'file'            => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('content_page_attachments_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentPageAttachments';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'content_page_id' => 'Number',
      'file'            => 'Text',
    );
  }
}
