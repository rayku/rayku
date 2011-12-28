<?php
// auto-generated by sfPropelCrud
// date: 2009/12/07 03:43:40
?>
<?php

/**
 * experts_immediate_lesson actions.
 *
 * @package    elifes
 * @subpackage experts_immediate_lesson
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
 
class experts_immediate_lessonActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('experts_immediate_lesson', 'list');
  }

  public function executeList()
  {
    
	$c=new Criteria();
	$c->add(ExpertsImmediateLessonPeer::USER_ID,$this->getUser()->getRaykuUserId());
	$this->experts_immediate_lessons = ExpertsImmediateLessonPeer::doSelect($c);
	
	
	
  }

  public function executeShow()
  {
    $this->experts_immediate_lesson = ExpertsImmediateLessonPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->experts_immediate_lesson);
  }


  public function executeCreate()
  {
    
	$this->experts_immediate_lesson = new ExpertsImmediateLesson();
	
	$this->experts_immediate_lesson->setUserId($this->getUser()->getRaykuUserId());

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->experts_immediate_lesson = ExpertsImmediateLessonPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->experts_immediate_lesson);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $experts_immediate_lesson = new ExpertsImmediateLesson();
    }
    else
    {
      $experts_immediate_lesson = ExpertsImmediateLessonPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($experts_immediate_lesson);
    }

   // $experts_immediate_lesson->setId($this->getRequestParameter('id'));
    $experts_immediate_lesson->setTitle($this->getRequestParameter('title'));
    $experts_immediate_lesson->setContent($this->getRequestParameter('content'));
    $experts_immediate_lesson->setPrice($this->getRequestParameter('price'));
    $experts_immediate_lesson->setUserId($this->getRequestParameter('user_id'));

    $experts_immediate_lesson->save();

    return $this->redirect('experts_immediate_lesson/show?id='.$experts_immediate_lesson->getId());
  }

  public function executeDelete()
  {
    $experts_immediate_lesson = ExpertsImmediateLessonPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($experts_immediate_lesson);

    $experts_immediate_lesson->delete();

    return $this->redirect('experts_immediate_lesson/list');
  }
}
