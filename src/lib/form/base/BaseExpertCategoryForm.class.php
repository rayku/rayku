<?php

/**
 * ExpertCategory form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseExpertCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'ExpertCategory', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('expert_category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertCategory';
  }


}
