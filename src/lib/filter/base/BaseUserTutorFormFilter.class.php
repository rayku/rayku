<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserTutor filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseUserTutorFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('user_tutor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserTutor';
  }

  public function getFields()
  {
    return array(
      'userid' => 'ForeignKey',
    );
  }
}
