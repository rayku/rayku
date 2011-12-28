<?php

/**
 * ClassroomBlog form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseClassroomBlogForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'title'        => new sfWidgetFormInput(),
      'message'      => new sfWidgetFormTextarea(),
      'classroom_id' => new sfWidgetFormPropelChoice(array('model' => 'Classroom', 'add_empty' => false)),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorPropelChoice(array('model' => 'ClassroomBlog', 'column' => 'id', 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 200)),
      'message'      => new sfValidatorString(),
      'classroom_id' => new sfValidatorPropelChoice(array('model' => 'Classroom', 'column' => 'id')),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('classroom_blog[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ClassroomBlog';
  }


}
