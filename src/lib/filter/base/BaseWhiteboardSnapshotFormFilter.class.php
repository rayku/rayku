<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WhiteboardSnapshot filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseWhiteboardSnapshotFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'whiteboard_chat_id' => new sfWidgetFormPropelChoice(array('model' => 'WhiteboardChat', 'add_empty' => true)),
      'filename'           => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'whiteboard_chat_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WhiteboardChat', 'column' => 'id')),
      'filename'           => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_snapshot_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardSnapshot';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'whiteboard_chat_id' => 'ForeignKey',
      'filename'           => 'Text',
      'created_at'         => 'Date',
    );
  }
}
