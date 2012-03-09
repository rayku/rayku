<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * JournalEntryAcl filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseJournalEntryAclFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'journal_entry_id' => new sfWidgetFormFilterInput(),
      'user_id'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'journal_entry_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('journal_entry_acl_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'JournalEntryAcl';
  }

  public function getFields()
  {
    return array(
      'journal_entry_id' => 'Number',
      'user_id'          => 'Number',
      'id'               => 'Number',
    );
  }
}
