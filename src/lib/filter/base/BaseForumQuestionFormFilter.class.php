<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ForumQuestion filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseForumQuestionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'       => new sfWidgetFormFilterInput(),
      'question'    => new sfWidgetFormFilterInput(),
      'category_id' => new sfWidgetFormFilterInput(),
      'user_id'     => new sfWidgetFormFilterInput(),
      'visible'     => new sfWidgetFormFilterInput(),
      'cancel'      => new sfWidgetFormFilterInput(),
      'notify'      => new sfWidgetFormFilterInput(),
      'tags'        => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'title'       => new sfValidatorPass(array('required' => false)),
      'question'    => new sfValidatorPass(array('required' => false)),
      'category_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'visible'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cancel'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notify'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tags'        => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('forum_question_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ForumQuestion';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'title'       => 'Text',
      'question'    => 'Text',
      'category_id' => 'Number',
      'user_id'     => 'Number',
      'visible'     => 'Number',
      'cancel'      => 'Number',
      'notify'      => 'Number',
      'tags'        => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
