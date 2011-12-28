<?php

/**
 * Forum form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseForumForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInput(),
      'description'   => new sfWidgetFormTextarea(),
      'type'          => new sfWidgetFormInput(),
      'entity_id'     => new sfWidgetFormInput(),
      'top_or_bottom' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Forum', 'column' => 'id', 'required' => false)),
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'type'          => new sfValidatorInteger(array('required' => false)),
      'entity_id'     => new sfValidatorInteger(array('required' => false)),
      'top_or_bottom' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('forum[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Forum';
  }


}
