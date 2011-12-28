<?php

/**
 * JournalEntry form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseJournalEntryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'subject'     => new sfWidgetFormInput(),
      'content'     => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'show_entity' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'JournalEntry', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'subject'     => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'content'     => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'show_entity' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journal_entry[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JournalEntry';
  }


}
