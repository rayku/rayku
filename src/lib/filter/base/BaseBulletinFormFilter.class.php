<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Bulletin filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseBulletinFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'poster_id'  => new sfWidgetFormFilterInput(),
      'content'    => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'poster_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'content'    => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('bulletin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bulletin';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'poster_id'  => 'Number',
      'content'    => 'Text',
      'created_at' => 'Date',
    );
  }
}
