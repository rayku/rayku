<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * WhiteboardSession filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseWhiteboardSessionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'question_id'   => new sfWidgetFormPropelChoice(array('model' => 'StudentQuestion', 'add_empty' => true)),
      'user_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'type'          => new sfWidgetFormFilterInput(),
      'token'         => new sfWidgetFormFilterInput(),
      'chat_id'       => new sfWidgetFormFilterInput(),
      'last_activity' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'question_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'StudentQuestion', 'column' => 'id')),
      'user_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'type'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'token'         => new sfValidatorPass(array('required' => false)),
      'chat_id'       => new sfValidatorPass(array('required' => false)),
      'last_activity' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('whiteboard_session_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WhiteboardSession';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'question_id'   => 'ForeignKey',
      'user_id'       => 'ForeignKey',
      'type'          => 'Number',
      'token'         => 'Text',
      'chat_id'       => 'Text',
      'last_activity' => 'Number',
    );
  }
}
