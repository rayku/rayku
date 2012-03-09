<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * GalleryAcl filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseGalleryAclFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'gallery_id' => new sfWidgetFormFilterInput(),
      'user_id'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'gallery_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('gallery_acl_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GalleryAcl';
  }

  public function getFields()
  {
    return array(
      'gallery_id' => 'Number',
      'user_id'    => 'Number',
      'id'         => 'Number',
    );
  }
}
