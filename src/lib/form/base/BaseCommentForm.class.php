<?php

/**
 * Comment form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'journal_entry_id' => new sfWidgetFormPropelChoice(array('model' => 'JournalEntry', 'add_empty' => true)),
      'poster_id'        => new sfWidgetFormInput(),
      'picture_id'       => new sfWidgetFormInput(),
      'video_id'         => new sfWidgetFormInput(),
      'content'          => new sfWidgetFormTextarea(),
      'created_at'       => new sfWidgetFormDateTime(),
      'type'             => new sfWidgetFormInput(),
      'approved'         => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'Comment', 'column' => 'id', 'required' => false)),
      'journal_entry_id' => new sfValidatorPropelChoice(array('model' => 'JournalEntry', 'column' => 'id', 'required' => false)),
      'poster_id'        => new sfValidatorInteger(array('required' => false)),
      'picture_id'       => new sfValidatorInteger(array('required' => false)),
      'video_id'         => new sfValidatorInteger(array('required' => false)),
      'content'          => new sfValidatorString(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'type'             => new sfValidatorInteger(array('required' => false)),
      'approved'         => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comment';
  }


}
