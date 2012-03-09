<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ReportEntity filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseReportEntityFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'report_count'       => new sfWidgetFormFilterInput(),
      'thread_id'          => new sfWidgetFormFilterInput(),
      'post_id'            => new sfWidgetFormFilterInput(),
      'group_id'           => new sfWidgetFormFilterInput(),
      'bulletin_id'        => new sfWidgetFormFilterInput(),
      'group_site_page_id' => new sfWidgetFormFilterInput(),
      'comment_id'         => new sfWidgetFormFilterInput(),
      'picture_id'         => new sfWidgetFormFilterInput(),
      'video_id'           => new sfWidgetFormFilterInput(),
      'shout_id'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'report_count'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'thread_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'post_id'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'group_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'bulletin_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'group_site_page_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comment_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'picture_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'video_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'shout_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('report_entity_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReportEntity';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'report_count'       => 'Number',
      'thread_id'          => 'Number',
      'post_id'            => 'Number',
      'group_id'           => 'Number',
      'bulletin_id'        => 'Number',
      'group_site_page_id' => 'Number',
      'comment_id'         => 'Number',
      'picture_id'         => 'Number',
      'video_id'           => 'Number',
      'shout_id'           => 'Number',
    );
  }
}
