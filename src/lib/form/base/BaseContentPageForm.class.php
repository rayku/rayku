<?php

/**
 * ContentPage form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseContentPageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInput(),
      'content'      => new sfWidgetFormTextarea(),
      'classroom_id' => new sfWidgetFormInput(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'ContentPage', 'column' => 'id', 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 100)),
      'content'      => new sfValidatorString(),
      'classroom_id' => new sfValidatorInteger(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('content_page[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContentPage';
  }


}
