<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertCategory filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertCategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'category_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('expert_category_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertCategory';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'user_id'     => 'ForeignKey',
      'category_id' => 'ForeignKey',
    );
  }
}
