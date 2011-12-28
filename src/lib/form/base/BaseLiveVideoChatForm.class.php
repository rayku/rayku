<?php

/**
 * LiveVideoChat form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseLiveVideoChatForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'receiver_id'  => new sfWidgetFormInput(),
      'sender_id'    => new sfWidgetFormInput(),
      'classroom_id' => new sfWidgetFormInput(),
      'approved'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'LiveVideoChat', 'column' => 'id', 'required' => false)),
      'receiver_id'  => new sfValidatorInteger(),
      'sender_id'    => new sfValidatorInteger(),
      'classroom_id' => new sfValidatorInteger(),
      'approved'     => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('live_video_chat[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'LiveVideoChat';
  }


}
