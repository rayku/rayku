<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ChatUser filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseChatUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_name' => new sfWidgetFormFilterInput(),
      'status'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_name' => new sfValidatorPass(array('required' => false)),
      'status'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('chat_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChatUser';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'user_name' => 'Text',
      'status'    => 'Number',
    );
  }
}
