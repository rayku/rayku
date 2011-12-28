<?php

/**

 * forum_question actions.

 *

 * @package    elifes

 * @subpackage forum_question

 * @author     Your name here

 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $

 */

class forum_questionActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('forum_question', 'list');
  }

  public function executeList()
  {
		$c = new Criteria();
		$c->add(ThreadPeer::POSTER_ID,$this->getUser()->getRaykuUserId());
		$c->add(ThreadPeer::CANCEL,'0');
		$c->addDescendingOrderByColumn(ThreadPeer::LASTPOST_AT);
		$c->add(ThreadPeer::CANCEL,0);
		
		//Setup the pager and grab the appropriate resultset
		$this->threads  = ThreadPeer::doSelect( $c );
		
		$this->temp ='0';
	
		$c1=new Criteria();
		$c1->add(ForumQuestionPeer::USER_ID,$this->getUser()->getRaykuUserId());
		$c1->add(ForumQuestionPeer::VISIBLE,'1');
		$c1->setDistinct();
		$answeredqns=ForumQuestionPeer::doCount($c1);
				
    if($answeredqns >=2)
    {
      $c=new Criteria();
      $c->add(ForumQuestionPeer::USER_ID,$this->getUser()->getRaykuUserId());
      $c->add(ForumQuestionPeer::VISIBLE,'1');
      $c1->setDistinct();
      $visiblequestions=ForumQuestionPeer::doSelect($c);

      $count=$answeredqns;

      foreach($visiblequestions as $id)
      {
        $c=new Criteria();
          $c->add(ForumAnswerPeer::FORUM_QUESTION_ID,$id->getId());
          $c->add(ForumAnswerPeer::BEST_RESPONSE,'1');
          $bestanswers=ForumAnswerPeer::doSelect($c);

          if($bestanswers != NULL)
          {
            $count--;
          }
      }

      if($count < 2) {
        $this->temp = '0';
      }
    }
    else
    {
      $this->temp = '0';
    }
  }
  
  public function executeBestResponse()
  {
		$this->qnid = $this->getRequestParameter('qnid');
		
		$ans = ForumAnswerPeer::retrieveByPK( $this->getRequestParameter('ansid') );
		$qns = ForumQuestionPeer::retrieveByPK( $this->qnid );

    if( !$ans instanceof ForumAnswer || !$qns instanceof ForumQuestion )
    {
      $this->error = "Error";
      return sfView::ERROR;
    }

		if( !$qns->isLoggedUserOwner() )
    {
      $this->error = "You don't have sufficient permissions.";
      return sfView::ERROR;
    }

    if( $ans->getBestResponse() == 1 )
    {
      $this->error = "Reply is already set as Best Response.";
      return sfView::ERROR;
    }

    $ans->setBestResponse('1');
    $ans->save();

    $qns->setVisible('0');
    $qns->save();

    $user = UserPeer::retrieveByPK( $ans->getUserId() );

    $subject='Best Response Selected';

    If( $user->getType() == UserPeer::getTypeFromValue('expert') )
    {
      sfProjectConfiguration::getActive()->loadHelpers( 'Partial' );
      $body = get_partial( 'best_response_expert_message', array( 'user' => $user, 'ans' => $ans, 'qns' => $qns ) );

      //Grab the user object
      $currentuser = $this->getUser()->getRaykuUser();
      $currentuser->sendMessage( $this->getUser()->getRaykuUserId(), $subject, $body );
    }
    else
    {
      sfProjectConfiguration::getActive()->loadHelpers( 'Partial' );
      $body = get_partial( 'best_response_message', array( 'user' => $user, 'ans' => $ans, 'qns' => $qns ) );

      //Grab the user object
      $currentuser = $this->getUser()->getRaykuUser();
      $currentuser->sendMessage($user->getId(),$subject,$body);
    }
		
  }

  public function executeStatus()
  {
    $c = new Criteria();

    $c->add(ForumQuestionPeer::USER_ID, $this->getUser()->getRaykuUserId());
    $c->add(ForumQuestionPeer::VISIBLE, '1');

    $questions = ForumQuestionPeer::doSelect($c);


    if( $this->getRequestParameter('qnid') )
    {
      //search for previous best response
      $c = new Criteria();
      $c->add(ForumAnswerPeer::FORUM_QUESTION_ID, $this->getRequestParameter('qnid'));
      $c->add(ForumAnswerPeer::BEST_RESPONSE, 1);

      $bestresponse = ForumAnswerPeer::doSelect($c);

      if(count($bestresponse) > 0)
      {
        return sfView::ERROR;
      }
    }
	
    if( (count($questions) < 2) OR ($this->getRequestParameter('value') == 0))
    {
      $c=new Criteria();
      $c->add(ForumQuestionPeer::ID,$this->getRequestParameter('qnid'));
      $forumqn=ForumQuestionPeer::doSelectOne($c);

      if($forumqn->getVisible() == 1)
      {
          $forumqn->setVisible(0);
      }
      else
      {
          $forumqn->setVisible(1);
      }

      $forumqn->save();

      $this->success = 1;
    }
    else
    {
      $this->success = '';
    }
		
  }


  public function executeShow()
  {
    $this->qnid=$this->getRequestParameter('id');
   
    $this->forum_question = ForumQuestionPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($this->forum_question);

    $c = new Criteria();

    $c->add(ForumAnswerPeer::FORUM_QUESTION_ID, $this->getRequestParameter('id'));
    $c->addDescendingOrderByColumn('BEST_RESPONSE');
    $this->forum_answers = ForumAnswerPeer::doSelect($c);
  }

  public function executeCreate()
  {
		$this->forum_question = new ForumQuestion();
	
		$this->forum_question->setUserId($this->getUser()->getRaykuUserId());
	
		$this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->forum_question = ForumQuestionPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($this->forum_question);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $forum_question = new ForumQuestion();
    }
    else
    {
      $forum_question = ForumQuestionPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($forum_question);
    }

    $forum_question->setId($this->getRequestParameter('id'));
    $forum_question->setTitle($this->getRequestParameter('title'));
    $forum_question->setQuestion($this->getRequestParameter('question'));
    $forum_question->setCategoryId($this->getRequestParameter('category_id'));
    $forum_question->setUserId($this->getRequestParameter('user_id'));
    $forum_question->setNotify($this->getRequestParameter('notify',false));
    $forum_question->setTags($this->getRequestParameter('tags'));
    $forum_question->save();

	  return $this->redirect('forum_question/show?id='.$forum_question->getId());
  }

  public function executeDelete()
  {
    $forum_question = ForumQuestionPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($forum_question);

    $forum_question->delete();

    return $this->redirect('forum_question/list');
  }
  
  public function executeSearch()
  {
  	$search_query = $this->getRequestParameter('searchquery');
	
    $this->searchresult = 0 ;

    if($search_query)
    {
      $keywords = explode(' ',$search_query);

      $ids = array();

      foreach($keywords as $keyword)
      {
        $c = new Criteria();
        $c->add(ForumQuestionPeer::TAGS, "%{$keyword}%",Criteria::LIKE);
        $results = ForumQuestionPeer::doSelect($c);

        foreach($results as $row)
        {
          $ids[] = $row;
        }

      }

        $this->searchresult = 1;
        $this->resultids = $ids;
    }
  }
  
}