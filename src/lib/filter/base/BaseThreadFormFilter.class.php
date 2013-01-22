<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Thread filter form base class.
 *
 * @package    elifes
 * @subpackage filter
 * @author     Your name here
 */
class BaseThreadFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'poster_id'     => new sfWidgetFormFilterInput(),
      'forum_id'      => new sfWidgetFormFilterInput(),
      'title'         => new sfWidgetFormFilterInput(),
      'tags'          => new sfWidgetFormFilterInput(),
      'visible'       => new sfWidgetFormFilterInput(),
      'cancel'        => new sfWidgetFormFilterInput(),
      'category_id'   => new sfWidgetFormFilterInput(),
      'notify_email'  => new sfWidgetFormFilterInput(),
      'notify_pm'     => new sfWidgetFormFilterInput(),
      'notify_sms'    => new sfWidgetFormFilterInput(),
      'cell_number'   => new sfWidgetFormFilterInput(),
      'school_grade'  => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'lastpost_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'user_ip'       => new sfWidgetFormFilterInput(),
      'banned'        => new sfWidgetFormFilterInput(),
      'reported'      => new sfWidgetFormFilterInput(),
      'reported_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'stickie'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'poster_id'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'forum_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'title'         => new sfValidatorPass(array('required' => false)),
      'tags'          => new sfValidatorPass(array('required' => false)),
      'visible'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cancel'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'category_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notify_email'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notify_pm'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'notify_sms'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cell_number'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'school_grade'  => new sfValidatorPass(array('required' => false)),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'lastpost_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_ip'       => new sfValidatorPass(array('required' => false)),
      'banned'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reported'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'reported_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'stickie'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('thread_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Thread';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'poster_id'     => 'Number',
      'forum_id'      => 'Number',
      'title'         => 'Text',
      'tags'          => 'Text',
      'visible'       => 'Number',
      'cancel'        => 'Number',
      'category_id'   => 'Number',
      'notify_email'  => 'Number',
      'notify_pm'     => 'Number',
      'notify_sms'    => 'Number',
      'cell_number'   => 'Number',
      'school_grade'  => 'Text',
      'created_at'    => 'Date',
      'lastpost_at'   => 'Date',
      'user_ip'       => 'Text',
      'banned'        => 'Number',
      'reported'      => 'Number',
      'reported_date' => 'Date',
      'stickie'       => 'Number',
    );
  }
}
