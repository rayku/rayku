<?php

/**
 * GroupSitePage form base class.
 *
 * @package    elifes
 * @subpackage form
 * @author     Your name here
 */
class BaseGroupSitePageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'title'      => new sfWidgetFormInput(),
      'group_id'   => new sfWidgetFormInput(),
      'content'    => new sfWidgetFormTextarea(),
      'page_order' => new sfWidgetFormInput(),
      'template'   => new sfWidgetFormInput(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorPropelChoice(array('model' => 'GroupSitePage', 'column' => 'id', 'required' => false)),
      'title'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'group_id'   => new sfValidatorInteger(array('required' => false)),
      'content'    => new sfValidatorString(array('required' => false)),
      'page_order' => new sfValidatorInteger(array('required' => false)),
      'template'   => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('group_site_page[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GroupSitePage';
  }


}
