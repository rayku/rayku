<?php

/**
 * trust_information actions.
 *
 * @package    elifes
 * @subpackage trust_information
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class trust_informationActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    	//$this->forward('default', 'module');
		
		
		if($this->getUser()->getRaykuUser()->getType() == '1')
		{
		
			$this->user=$this->getUser()->getRaykuUserId();
		
						
			$c1=new Criteria();
			$c1->addJoin(ForumQuestionPeer::ID,ForumAnswerPeer::FORUM_QUESTION_ID,Criteria::JOIN);
			$c1->add(ForumAnswerPeer::BEST_RESPONSE,1);
			$c1->setDistinct();
			$this->questions=ForumQuestionPeer::doSelect($c1); 
			
			
		//	print_r($this->questions);
			
			
		
		}
		
		
  }
}
