<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ClassroomMembers filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseClassroomMembersFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'category_id'  => new sfWidgetFormFilterInput(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => true)),
      'approved'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'category_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'classroom_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Classroom', 'column' => 'id')),
      'approved'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('classroom_members_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomMembers';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_id'      => 'ForeignKey',
      'category_id'  => 'Number',
      'classroom_id' => 'ForeignKey',
      'approved'     => 'Number',
    );
  }
}
