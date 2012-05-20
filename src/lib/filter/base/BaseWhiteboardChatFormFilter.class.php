<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WhiteboardChat filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseWhiteboardChatFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_public'       => new sfWidgetFormFilterInput(),
      'expert_id'       => new sfWidgetFormFilterInput(),
      'asker_id'        => new sfWidgetFormFilterInput(),
      'expert_nickname' => new sfWidgetFormFilterInput(),
      'asker_nickname'  => new sfWidgetFormFilterInput(),
      'question'        => new sfWidgetFormFilterInput(),
      'started_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'ended_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'directory'       => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'timer'           => new sfWidgetFormFilterInput(),
      'rating'          => new sfWidgetFormFilterInput(),
      'amount'          => new sfWidgetFormFilterInput(),
      'comments'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'is_public'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'asker_id'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_nickname' => new sfValidatorPass(array('required' => false)),
      'asker_nickname'  => new sfValidatorPass(array('required' => false)),
      'question'        => new sfValidatorPass(array('required' => false)),
      'started_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'ended_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'directory'       => new sfValidatorPass(array('required' => false)),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'timer'           => new sfValidatorPass(array('required' => false)),
      'rating'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'comments'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_chat_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardChat';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'is_public'       => 'Number',
      'expert_id'       => 'Number',
      'asker_id'        => 'Number',
      'expert_nickname' => 'Text',
      'asker_nickname'  => 'Text',
      'question'        => 'Text',
      'started_at'      => 'Date',
      'ended_at'        => 'Date',
      'directory'       => 'Text',
      'created_at'      => 'Date',
      'timer'           => 'Text',
      'rating'          => 'Number',
      'amount'          => 'Number',
      'comments'        => 'Text',
    );
  }
}
