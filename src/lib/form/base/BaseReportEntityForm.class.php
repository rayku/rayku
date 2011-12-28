<?php

/**
 * ReportEntity form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseReportEntityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'report_count'       => new sfWidgetFormInput(),
      'thread_id'          => new sfWidgetFormInput(),
      'post_id'            => new sfWidgetFormInput(),
      'group_id'           => new sfWidgetFormInput(),
      'bulletin_id'        => new sfWidgetFormInput(),
      'group_site_page_id' => new sfWidgetFormInput(),
      'comment_id'         => new sfWidgetFormInput(),
      'picture_id'         => new sfWidgetFormInput(),
      'video_id'           => new sfWidgetFormInput(),
      'shout_id'           => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'ReportEntity', 'column' => 'id', 'required' => false)),
      'report_count'       => new sfValidatorInteger(array('required' => false)),
      'thread_id'          => new sfValidatorInteger(array('required' => false)),
      'post_id'            => new sfValidatorInteger(array('required' => false)),
      'group_id'           => new sfValidatorInteger(array('required' => false)),
      'bulletin_id'        => new sfValidatorInteger(array('required' => false)),
      'group_site_page_id' => new sfValidatorInteger(array('required' => false)),
      'comment_id'         => new sfValidatorInteger(array('required' => false)),
      'picture_id'         => new sfValidatorInteger(array('required' => false)),
      'video_id'           => new sfValidatorInteger(array('required' => false)),
      'shout_id'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('thread_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('post_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('group_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('bulletin_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('group_site_page_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('comment_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('picture_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('video_id'))),
        new sfValidatorPropelUnique(array('model' => 'ReportEntity', 'column' => array('shout_id'))),
      ))
    );

    $this->widgetSchema->setNameFormat('report_entity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ReportEntity';
  }


}
