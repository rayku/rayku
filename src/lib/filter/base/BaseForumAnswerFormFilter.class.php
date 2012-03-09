<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ForumAnswer filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseForumAnswerFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'answer'            => new sfWidgetFormFilterInput(),
      'forum_question_id' => new sfWidgetFormFilterInput(),
      'user_id'           => new sfWidgetFormFilterInput(),
      'best_response'     => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'answer'            => new sfValidatorPass(array('required' => false)),
      'forum_question_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'best_response'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('forum_answer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumAnswer';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'answer'            => 'Text',
      'forum_question_id' => 'Number',
      'user_id'           => 'Number',
      'best_response'     => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
