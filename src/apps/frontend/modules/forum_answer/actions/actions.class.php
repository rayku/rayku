<?php

/**
 * forum_answer actions.
 *
 * @package    elifes
 * @subpackage forum_answer
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
 
 
class forum_answerActions extends sfActions
{
  private function getRequestedForumAnswer()
  {
	  $forum_answer = ForumAnswerPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless( $forum_answer );

    return $forum_answer;
  }

  private function createNewForumAnswer()
  {
    $forum_answer = new ForumAnswer();
    $forum_answer->setUserId($this->getUser()->getRaykuUserId());

    $forum_question = ForumQuestionPeer::retrieveByPK( $this->getRequestParameter('forum_question_id') );
    $this->forward404Unless( $forum_question );

    $forum_answer->setForumQuestionId( $forum_question->getId() );

    return $forum_answer;
  }

  public function executeIndex()
  {
    return $this->forward('forum_answer', 'list');
  }

  public function executeList()
  {
		$c=new Criteria();
		$c->addDescendingOrderByColumn(ForumAnswerPeer::ID);
		$this->forum_answers = ForumAnswerPeer::doSelect($c);
  }

  public function executeShow()
  {
    $this->forum_answer = ForumAnswerPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->forum_answer);
  }

  public function executeCreate()
  {
    $this->forum_answer = $this->createNewForumAnswer();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->forum_answer = $this->getRequestedForumAnswer();
  }

  public function executeUpdate()
  {
    if( $this->hasRequestParameter('id') &&
        is_numeric( $this->getRequestParameter('id') )
      )
    {
      $forum_answer = $this->getRequestedForumAnswer();
    }
    else
    {
      $forum_answer = $this->createNewForumAnswer();
    }

    $forum_answer->setAnswer($this->getRequestParameter('answer'));
    $forum_answer->save();

    return $this->redirect('forum_question/show?id='.$forum_answer->getForumQuestionId());
  }

  public function executeDelete()
  {
    $forum_answer = ForumAnswerPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($forum_answer);

    $forum_answer->delete();

    return $this->redirect('forum_question/list');
  }
 
  public function executeViewAnswers()
  {
    $this->user=$this->getUser()->getRaykuUserId();
		
		$c=new Criteria();
		$c->add(ForumQuestionPeer::USER_ID,$this->getUser()->getRaykuUserId());
		$this->userQuestion=ForumQuestionPeer::doSelect($c);
		
		
		$this->questionid=$this->getRequestParameter('id');
		
		$c=new Criteria();
		$c->add(ForumQuestionPeer::ID,$this->questionid);
		$this->question=ForumQuestionPeer::doSelectOne($c);
  }

	public function executeQuestionstatus()
  {
			$this->questnId=$this->getRequestParameter('qn_id');
			$this->status = $this->getRequestParameter('status');
					
			$c=new Criteria();
			$c->add(ForumQuestionPeer::ID,$this->questnId);
			$this->question=ForumQuestionPeer::doSelectOne($c);
				
			if($this->status == 'close') {
			
				$this->question->setVisible('0');
				$this->question->save();
				
				return $this->redirect('forum_answer/viewAnswers?id='.$this->question->getId());

		//		$this->msg="Your thread '".$this->thread->getTitle()."' is successfully closed!";
			}
			
			if($this->status == 'reactive')
      {
				$this->question->setVisible('1');
				$this->question->save();
				
				return $this->redirect('forum_answer/viewAnswers?id='.$this->question->getId());
				
		//		$this->msg="Your thread  '".$this->thread->getTitle()."'  is successfully re-activated!";
			}
			
			if($this->status == 'cancel')
      {
				$this->question->setCancel('1');
				$this->question->save();
				
   	 			return $this->redirect('forum_question/list');
			
			//	return $this->forward('forum', $this->thread->getForumId());
			}
	}
}