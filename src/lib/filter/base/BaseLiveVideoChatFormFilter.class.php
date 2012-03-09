<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * LiveVideoChat filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseLiveVideoChatFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'receiver_id'  => new sfWidgetFormFilterInput(),
      'sender_id'    => new sfWidgetFormFilterInput(),
      'classroom_id' => new sfWidgetFormFilterInput(),
      'approved'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'receiver_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sender_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'classroom_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'approved'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('live_video_chat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LiveVideoChat';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'receiver_id'  => 'Number',
      'sender_id'    => 'Number',
      'classroom_id' => 'Number',
      'approved'     => 'Number',
    );
  }
}
