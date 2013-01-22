<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WhiteboardTutorFeedback filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseWhiteboardTutorFeedbackFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'whiteboard_chat_id' => new sfWidgetFormPropelChoice(array('model' => 'WhiteboardChat', 'add_empty' => true)),
      'expert_id'          => new sfWidgetFormFilterInput(),
      'audio'              => new sfWidgetFormFilterInput(),
      'usability'          => new sfWidgetFormFilterInput(),
      'overall'            => new sfWidgetFormFilterInput(),
      'feedback'           => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'whiteboard_chat_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'WhiteboardChat', 'column' => 'id')),
      'expert_id'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'audio'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'usability'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'overall'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'feedback'           => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_tutor_feedback_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardTutorFeedback';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'whiteboard_chat_id' => 'ForeignKey',
      'expert_id'          => 'Number',
      'audio'              => 'Number',
      'usability'          => 'Number',
      'overall'            => 'Number',
      'feedback'           => 'Text',
      'created_at'         => 'Date',
    );
  }
}
