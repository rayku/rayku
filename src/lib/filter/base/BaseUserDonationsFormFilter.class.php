<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserDonations filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserDonationsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'from_user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'points'       => new sfWidgetFormFilterInput(),
      'comments'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'from_user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'points'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'comments'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_donations_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserDonations';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_id'      => 'ForeignKey',
      'from_user_id' => 'ForeignKey',
      'points'       => 'Number',
      'comments'     => 'Text',
    );
  }
}
