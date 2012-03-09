<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * PrivateMessage filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BasePrivateMessageFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'subject'      => new sfWidgetFormFilterInput(),
      'body'         => new sfWidgetFormFilterInput(),
      'sender_id'    => new sfWidgetFormFilterInput(),
      'recipient_id' => new sfWidgetFormFilterInput(),
      'status'       => new sfWidgetFormFilterInput(),
      'read_status'  => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'type'         => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'subject'      => new sfValidatorPass(array('required' => false)),
      'body'         => new sfValidatorPass(array('required' => false)),
      'sender_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'recipient_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'read_status'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'type'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('private_message_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PrivateMessage';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'subject'      => 'Text',
      'body'         => 'Text',
      'sender_id'    => 'Number',
      'recipient_id' => 'Number',
      'status'       => 'Number',
      'read_status'  => 'Number',
      'created_at'   => 'Date',
      'type'         => 'Number',
    );
  }
}
