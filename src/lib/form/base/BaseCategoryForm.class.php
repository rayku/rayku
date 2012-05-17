<?php

/**
 * Category form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseCategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'parent'      => new sfWidgetFormInput(),
      'prefix'      => new sfWidgetFormInput(),
      'updated_at'  => new sfWidgetFormDate(),
      'status'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 50)),
      'description' => new sfValidatorString(),
      'parent'      => new sfValidatorInteger(),
      'prefix'      => new sfValidatorString(array('max_length' => 10)),
      'updated_at'  => new sfValidatorDate(),
      'status'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'Category', 'column' => array('name'))),
        new sfValidatorPropelUnique(array('model' => 'Category', 'column' => array('prefix'))),
      ))
    );

    $this->widgetSchema->setNameFormat('category[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Category';
  }


}
