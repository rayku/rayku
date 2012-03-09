<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * StudentVoiceVotes filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseStudentVoiceVotesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'student_voice_id' => new sfWidgetFormPropelChoice(array('model' => 'StudentVoice', 'add_empty' => true)),
      'value'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'student_voice_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'StudentVoice', 'column' => 'id')),
      'value'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('student_voice_votes_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentVoiceVotes';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'student_voice_id' => 'ForeignKey',
      'value'            => 'Number',
    );
  }
}
