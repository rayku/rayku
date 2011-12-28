<?php

/**
 * ItemRating form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseItemRatingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'      => new sfWidgetFormInputHidden(),
      'item_id' => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'rating'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'      => new sfValidatorPropelChoice(array('model' => 'ItemRating', 'column' => 'id', 'required' => false)),
      'item_id' => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id', 'required' => false)),
      'user_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'rating'  => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_rating[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemRating';
  }


}
