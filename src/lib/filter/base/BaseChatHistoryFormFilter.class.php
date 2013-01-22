<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ChatHistory filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseChatHistoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name'   => new sfWidgetFormFilterInput(),
      'expert_name' => new sfWidgetFormFilterInput(),
      'text'        => new sfWidgetFormFilterInput(),
      'time'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'user_name'   => new sfValidatorPass(array('required' => false)),
      'expert_name' => new sfValidatorPass(array('required' => false)),
      'text'        => new sfValidatorPass(array('required' => false)),
      'time'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('chat_history_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChatHistory';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_name'   => 'Text',
      'expert_name' => 'Text',
      'text'        => 'Text',
      'time'        => 'Date',
    );
  }
}
