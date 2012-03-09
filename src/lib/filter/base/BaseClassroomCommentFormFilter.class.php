<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ClassroomComment filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseClassroomCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'classroom_blog_id' => new sfWidgetFormPropelChoice(array('model' => 'ClassroomBlog', 'add_empty' => true)),
      'user_id'           => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'content'           => new sfWidgetFormFilterInput(),
      'posted_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'approved'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'classroom_blog_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ClassroomBlog', 'column' => 'id')),
      'user_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'content'           => new sfValidatorPass(array('required' => false)),
      'posted_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'approved'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('classroom_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomComment';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'classroom_blog_id' => 'ForeignKey',
      'user_id'           => 'ForeignKey',
      'content'           => 'Text',
      'posted_at'         => 'Date',
      'approved'          => 'Number',
    );
  }
}
