<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ItemRating filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseItemRatingFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'item_id' => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'rating'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'item_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Item', 'column' => 'id')),
      'user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'rating'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('item_rating_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemRating';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'item_id' => 'ForeignKey',
      'user_id' => 'ForeignKey',
      'rating'  => 'Number',
    );
  }
}
