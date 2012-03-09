<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * GalleryItem filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseGalleryItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'            => new sfWidgetFormFilterInput(),
      'gallery_id'       => new sfWidgetFormPropelChoice(array('model' => 'Gallery', 'add_empty' => true)),
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'file_name'        => new sfWidgetFormFilterInput(),
      'file_system_path' => new sfWidgetFormFilterInput(),
      'mime_type'        => new sfWidgetFormFilterInput(),
      'is_image'         => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'title'            => new sfValidatorPass(array('required' => false)),
      'gallery_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Gallery', 'column' => 'id')),
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'file_name'        => new sfValidatorPass(array('required' => false)),
      'file_system_path' => new sfValidatorPass(array('required' => false)),
      'mime_type'        => new sfValidatorPass(array('required' => false)),
      'is_image'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('gallery_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GalleryItem';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'title'            => 'Text',
      'gallery_id'       => 'ForeignKey',
      'user_id'          => 'ForeignKey',
      'file_name'        => 'Text',
      'file_system_path' => 'Text',
      'mime_type'        => 'Text',
      'is_image'         => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
    );
  }
}
