<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserFb filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserFbFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'fb_username' => new sfWidgetFormFilterInput(),
      'fb_uid'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'fb_username' => new sfValidatorPass(array('required' => false)),
      'fb_uid'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_fb_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserFb';
  }

  public function getFields()
  {
    return array(
      'userid'      => 'ForeignKey',
      'fb_username' => 'Text',
      'fb_uid'      => 'Text',
    );
  }
}
