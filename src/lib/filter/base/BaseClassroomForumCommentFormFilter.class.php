<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ClassroomForumComment filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseClassroomForumCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'thread_id'    => new sfWidgetFormFilterInput(),
      'commentor_id' => new sfWidgetFormFilterInput(),
      'content'      => new sfWidgetFormFilterInput(),
      'approved'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'thread_id'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'commentor_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content'      => new sfValidatorPass(array('required' => false)),
      'approved'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('classroom_forum_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomForumComment';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'thread_id'    => 'Number',
      'commentor_id' => 'Number',
      'content'      => 'Text',
      'approved'     => 'Number',
    );
  }
}
