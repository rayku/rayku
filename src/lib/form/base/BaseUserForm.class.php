<?php

/**
 * User form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'picture_id'               => new sfWidgetFormPropelChoice(array('model' => 'Picture', 'add_empty' => true)),
      'username'                 => new sfWidgetFormInput(),
      'email'                    => new sfWidgetFormInput(),
      'password'                 => new sfWidgetFormInput(),
      'points'                   => new sfWidgetFormInput(),
      'created_at'               => new sfWidgetFormDateTime(),
      'last_activity_at'         => new sfWidgetFormDateTime(),
      'type'                     => new sfWidgetFormInput(),
      'hidden'                   => new sfWidgetFormInput(),
      'name'                     => new sfWidgetFormInput(),
      'gender'                   => new sfWidgetFormInput(),
      'hometown'                 => new sfWidgetFormInput(),
      'home_phone'               => new sfWidgetFormInput(),
      'mobile_phone'             => new sfWidgetFormInput(),
      'birthdate'                => new sfWidgetFormDate(),
      'address'                  => new sfWidgetFormTextarea(),
      'relationship_status'      => new sfWidgetFormInput(),
      'show_email'               => new sfWidgetFormInput(),
      'show_gender'              => new sfWidgetFormInput(),
      'show_hometown'            => new sfWidgetFormInput(),
      'show_home_phone'          => new sfWidgetFormInput(),
      'show_mobile_phone'        => new sfWidgetFormInput(),
      'show_birthdate'           => new sfWidgetFormInput(),
      'show_address'             => new sfWidgetFormInput(),
      'show_relationship_status' => new sfWidgetFormInput(),
      'password_recover_key'     => new sfWidgetFormInput(),
      'cookie_key'               => new sfWidgetFormInput(),
      'credit'                   => new sfWidgetFormInput(),
      'invisible'                => new sfWidgetFormInput(),
      'notification'             => new sfWidgetFormInput(),
      'phone_number'             => new sfWidgetFormInput(),
      'login'                    => new sfWidgetFormInput(),
      'credit_card'              => new sfWidgetFormInput(),
      'credit_card_token'        => new sfWidgetFormInput(),
      'first_charge'             => new sfWidgetFormDateTime(),
      'where_find_us'            => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'picture_id'               => new sfValidatorPropelChoice(array('model' => 'Picture', 'column' => 'id', 'required' => false)),
      'username'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'password'                 => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'points'                   => new sfValidatorNumber(array('required' => false)),
      'created_at'               => new sfValidatorDateTime(array('required' => false)),
      'last_activity_at'         => new sfValidatorDateTime(array('required' => false)),
      'type'                     => new sfValidatorInteger(array('required' => false)),
      'hidden'                   => new sfValidatorInteger(array('required' => false)),
      'name'                     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'gender'                   => new sfValidatorInteger(array('required' => false)),
      'hometown'                 => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'home_phone'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'mobile_phone'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'birthdate'                => new sfValidatorDate(array('required' => false)),
      'address'                  => new sfValidatorString(array('required' => false)),
      'relationship_status'      => new sfValidatorInteger(array('required' => false)),
      'show_email'               => new sfValidatorInteger(array('required' => false)),
      'show_gender'              => new sfValidatorInteger(array('required' => false)),
      'show_hometown'            => new sfValidatorInteger(array('required' => false)),
      'show_home_phone'          => new sfValidatorInteger(array('required' => false)),
      'show_mobile_phone'        => new sfValidatorInteger(array('required' => false)),
      'show_birthdate'           => new sfValidatorInteger(array('required' => false)),
      'show_address'             => new sfValidatorInteger(array('required' => false)),
      'show_relationship_status' => new sfValidatorInteger(array('required' => false)),
      'password_recover_key'     => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'cookie_key'               => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'credit'                   => new sfValidatorInteger(),
      'invisible'                => new sfValidatorInteger(),
      'notification'             => new sfValidatorString(array('max_length' => 10)),
      'phone_number'             => new sfValidatorString(array('max_length' => 20)),
      'login'                    => new sfValidatorInteger(),
      'credit_card'              => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'credit_card_token'        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'first_charge'             => new sfValidatorDateTime(array('required' => false)),
      'where_find_us'            => new sfValidatorString(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('username'))),
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('email'))),
        new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('password_recover_key'))),
      ))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
