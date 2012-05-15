<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * User filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'picture_id'               => new sfWidgetFormPropelChoice(array('model' => 'Picture', 'add_empty' => true)),
      'username'                 => new sfWidgetFormFilterInput(),
      'email'                    => new sfWidgetFormFilterInput(),
      'password'                 => new sfWidgetFormFilterInput(),
      'points'                   => new sfWidgetFormFilterInput(),
      'created_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_activity_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'type'                     => new sfWidgetFormFilterInput(),
      'hidden'                   => new sfWidgetFormFilterInput(),
      'name'                     => new sfWidgetFormFilterInput(),
      'gender'                   => new sfWidgetFormFilterInput(),
      'hometown'                 => new sfWidgetFormFilterInput(),
      'home_phone'               => new sfWidgetFormFilterInput(),
      'mobile_phone'             => new sfWidgetFormFilterInput(),
      'birthdate'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'address'                  => new sfWidgetFormFilterInput(),
      'relationship_status'      => new sfWidgetFormFilterInput(),
      'about_me'                 => new sfWidgetFormFilterInput(),
      'show_email'               => new sfWidgetFormFilterInput(),
      'show_gender'              => new sfWidgetFormFilterInput(),
      'show_hometown'            => new sfWidgetFormFilterInput(),
      'show_home_phone'          => new sfWidgetFormFilterInput(),
      'show_mobile_phone'        => new sfWidgetFormFilterInput(),
      'show_birthdate'           => new sfWidgetFormFilterInput(),
      'show_address'             => new sfWidgetFormFilterInput(),
      'show_relationship_status' => new sfWidgetFormFilterInput(),
      'show_hobbies'             => new sfWidgetFormFilterInput(),
      'password_recover_key'     => new sfWidgetFormFilterInput(),
      'cookie_key'               => new sfWidgetFormFilterInput(),
      'credit'                   => new sfWidgetFormFilterInput(),
      'invisible'                => new sfWidgetFormFilterInput(),
      'notification'             => new sfWidgetFormFilterInput(),
      'phone_number'             => new sfWidgetFormFilterInput(),
      'network_id'               => new sfWidgetFormPropelChoice(array('model' => 'Network', 'add_empty' => true)),
      'login'                    => new sfWidgetFormFilterInput(),
      'credit_card'              => new sfWidgetFormFilterInput(),
      'credit_card_token'        => new sfWidgetFormFilterInput(),
      'first_charge'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'picture_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Picture', 'column' => 'id')),
      'username'                 => new sfValidatorPass(array('required' => false)),
      'email'                    => new sfValidatorPass(array('required' => false)),
      'password'                 => new sfValidatorPass(array('required' => false)),
      'points'                   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_activity_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'type'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hidden'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'                     => new sfValidatorPass(array('required' => false)),
      'gender'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'hometown'                 => new sfValidatorPass(array('required' => false)),
      'home_phone'               => new sfValidatorPass(array('required' => false)),
      'mobile_phone'             => new sfValidatorPass(array('required' => false)),
      'birthdate'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'address'                  => new sfValidatorPass(array('required' => false)),
      'relationship_status'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'about_me'                 => new sfValidatorPass(array('required' => false)),
      'show_email'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_gender'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_hometown'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_home_phone'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_mobile_phone'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_birthdate'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_address'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_relationship_status' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'show_hobbies'             => new sfValidatorPass(array('required' => false)),
      'password_recover_key'     => new sfValidatorPass(array('required' => false)),
      'cookie_key'               => new sfValidatorPass(array('required' => false)),
      'credit'                   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'invisible'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notification'             => new sfValidatorPass(array('required' => false)),
      'phone_number'             => new sfValidatorPass(array('required' => false)),
      'network_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Network', 'column' => 'id')),
      'login'                    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'credit_card'              => new sfValidatorPass(array('required' => false)),
      'credit_card_token'        => new sfValidatorPass(array('required' => false)),
      'first_charge'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'picture_id'               => 'ForeignKey',
      'username'                 => 'Text',
      'email'                    => 'Text',
      'password'                 => 'Text',
      'points'                   => 'Number',
      'created_at'               => 'Date',
      'last_activity_at'         => 'Date',
      'type'                     => 'Number',
      'hidden'                   => 'Number',
      'name'                     => 'Text',
      'gender'                   => 'Number',
      'hometown'                 => 'Text',
      'home_phone'               => 'Text',
      'mobile_phone'             => 'Text',
      'birthdate'                => 'Date',
      'address'                  => 'Text',
      'relationship_status'      => 'Number',
      'about_me'                 => 'Text',
      'show_email'               => 'Number',
      'show_gender'              => 'Number',
      'show_hometown'            => 'Number',
      'show_home_phone'          => 'Number',
      'show_mobile_phone'        => 'Number',
      'show_birthdate'           => 'Number',
      'show_address'             => 'Number',
      'show_relationship_status' => 'Number',
      'show_hobbies'             => 'Text',
      'password_recover_key'     => 'Text',
      'cookie_key'               => 'Text',
      'credit'                   => 'Number',
      'invisible'                => 'Number',
      'notification'             => 'Text',
      'phone_number'             => 'Text',
      'network_id'               => 'ForeignKey',
      'login'                    => 'Number',
      'credit_card'              => 'Text',
      'credit_card_token'        => 'Text',
      'first_charge'             => 'Date',
    );
  }
}
