<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Invitation filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseInvitationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'        => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'receiver_email' => new sfWidgetFormFilterInput(),
      'receiver_code'  => new sfWidgetFormFilterInput(),
      'sent'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'receiver_email' => new sfValidatorPass(array('required' => false)),
      'receiver_code'  => new sfValidatorPass(array('required' => false)),
      'sent'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('invitation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Invitation';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'user_id'        => 'ForeignKey',
      'receiver_email' => 'Text',
      'receiver_code'  => 'Text',
      'sent'           => 'Number',
    );
  }
}
