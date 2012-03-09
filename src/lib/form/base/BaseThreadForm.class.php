<?php

/**
 * Thread form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseThreadForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'poster_id'    => new sfWidgetFormInput(),
      'forum_id'     => new sfWidgetFormInput(),
      'title'        => new sfWidgetFormInput(),
      'tags'         => new sfWidgetFormInput(),
      'visible'      => new sfWidgetFormInput(),
      'cancel'       => new sfWidgetFormInput(),
      'category_id'  => new sfWidgetFormInput(),
      'notify_email' => new sfWidgetFormInput(),
      'notify_pm'    => new sfWidgetFormInput(),
      'notify_sms'   => new sfWidgetFormInput(),
      'cell_number'  => new sfWidgetFormInput(),
      'school_grade' => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'lastpost_at'  => new sfWidgetFormDateTime(),
      'stickie'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'Thread', 'column' => 'id', 'required' => false)),
      'poster_id'    => new sfValidatorInteger(),
      'forum_id'     => new sfValidatorInteger(),
      'title'        => new sfValidatorString(array('max_length' => 100)),
      'tags'         => new sfValidatorString(array('max_length' => 100)),
      'visible'      => new sfValidatorInteger(),
      'cancel'       => new sfValidatorInteger(),
      'category_id'  => new sfValidatorInteger(),
      'notify_email' => new sfValidatorInteger(),
      'notify_pm'    => new sfValidatorInteger(),
      'notify_sms'   => new sfValidatorInteger(),
      'cell_number'  => new sfValidatorInteger(),
      'school_grade' => new sfValidatorString(array('max_length' => 100)),
      'created_at'   => new sfValidatorDateTime(),
      'lastpost_at'  => new sfValidatorDateTime(),
      'stickie'      => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('thread[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Thread';
  }


}
