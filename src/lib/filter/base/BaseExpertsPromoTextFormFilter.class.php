<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ExpertsPromoText filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseExpertsPromoTextFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'exp_id'  => new sfWidgetFormFilterInput(),
      'content' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'exp_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('experts_promo_text_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ExpertsPromoText';
  }

  public function getFields()
  {
    return array(
      'id'      => 'Number',
      'exp_id'  => 'Number',
      'content' => 'Text',
    );
  }
}
