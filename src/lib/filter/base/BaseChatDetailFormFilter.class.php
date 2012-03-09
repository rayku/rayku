<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ChatDetail filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseChatDetailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user'          => new sfWidgetFormFilterInput(),
      'expert'        => new sfWidgetFormFilterInput(),
      'minutes'       => new sfWidgetFormFilterInput(),
      'expert_agreed' => new sfWidgetFormFilterInput(),
      'user_ask'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user'          => new sfValidatorPass(array('required' => false)),
      'expert'        => new sfValidatorPass(array('required' => false)),
      'minutes'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expert_agreed' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'user_ask'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('chat_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChatDetail';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'user'          => 'Text',
      'expert'        => 'Text',
      'minutes'       => 'Number',
      'expert_agreed' => 'Number',
      'user_ask'      => 'Number',
    );
  }
}
