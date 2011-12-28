<?php

/**
 * JournalEntryAcl form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseJournalEntryAclForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'journal_entry_id' => new sfWidgetFormInput(),
      'user_id'          => new sfWidgetFormInput(),
      'id'               => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'journal_entry_id' => new sfValidatorInteger(array('required' => false)),
      'user_id'          => new sfValidatorInteger(array('required' => false)),
      'id'               => new sfValidatorPropelChoice(array('model' => 'JournalEntryAcl', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('journal_entry_acl[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JournalEntryAcl';
  }


}
