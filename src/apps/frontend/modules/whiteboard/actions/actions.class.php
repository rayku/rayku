<?php

/**
 * whiteboard actions.
 *
 * @package    elifes
 * @subpackage whiteboard
 * @author     Your name here
 * @version    
 */
class whiteboardActions extends sfActions
{
  /**
   * Executes index action
   *
   */ 
   /*
  public function executeIndex()
  {
    // query
    $criteria = new Criteria();
	  $criteria->add(WhiteboardChatPeer::IS_PUBLIC, true);
    $this->chat_list = WhiteboardChatPeer::doSelect($criteria);
    */
		/*
		if($this->getUser()->getRaykuUser()->getType() == '1')
		{
			$this->user=$this->getUser()->getRaykuUserId();				
			$c1=new Criteria();
			$c1->addJoin(ForumQuestionPeer::ID,ForumAnswerPeer::FORUM_QUESTION_ID,Criteria::JOIN);
			$c1->add(ForumAnswerPeer::BEST_RESPONSE,1);
			$c1->setDistinct();
			$this->questions=ForumQuestionPeer::doSelect($c1);
		  // print_r($this->questions);		
		}
		*/	
  //}
  
  
  /**
   * Executes sessions action
   *
   */ 
  public function executeSessions()
  {
    if(!empty($_COOKIE["timer"])) : 
	    $this->redirect('/dashboard/rating');
    endif; 

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
    $db = mysql_select_db("rayku_db", $con);
	  $name = explode("/", $_SERVER['REQUEST_URI']);	  
	  $query = mysql_query("select * from user where username='".$name[3]."' ") or die(mysql_error());
	  $row = mysql_fetch_array($query);
	  $userId = $row['id'];
    $this->userName = $row['name'];
    
    $loginUserId = $this->getUser()->getRaykuUserId();


    // query    
    $criteria = new Criteria();
    
    // sub query A: (is_public and (asker = user or expert = user))
    $cPublicA = $criteria->getNewCriterion(WhiteboardChatPeer::IS_PUBLIC, true);
    $cPublicA1 = $criteria->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
    $cPublicA2 = $criteria->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $userId);
    $cPublicA1->addOr($cPublicA2);
    $cPublicA->addAnd($cPublicA1);

    // sub query B: (is_private and (asker = login_user or expert = login_user))
    $cPublicB = $criteria->getNewCriterion(WhiteboardChatPeer::IS_PUBLIC, false);    
    $cPublicB1 = $criteria->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $loginUserId);
    $cPublicB2 = $criteria->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $loginUserId);
    $cPublicB1->addOr($cPublicB2);
    $cPublicB->addAnd($cPublicB1);
    
    // (sub query A OR sub query B)
    $cPublicA->addOr($cPublicB);
    $criteria->add($cPublicA);
    $criteria->add(WhiteboardChatPeer::STARTED_AT, null, Criteria::ISNOTNULL);
    $criteria->addDescendingOrderByColumn(WhiteboardChatPeer::ID);
    $this->chat_list = WhiteboardChatPeer::doSelect($criteria);
  }
  
  /**
   * Executes privateSessions action
   *
   */ 
  public function executePrivateSessions()
  {
    if(!empty($_COOKIE["timer"])) : 
	    $this->redirect('/dashboard/rating');
    endif; 

		$con = mysql_connect("localhost", "rayku_db", "db_*$%$%");
    $db = mysql_select_db("rayku_db", $con);
	  $name = explode("/", $_SERVER['REQUEST_URI']);	  
	  $query = mysql_query("select * from user where username='".$name[3]."' ") or die(mysql_error());
	  $row = mysql_fetch_array($query);
    
    $expertId = $row['id'];
	  $userId = $this->getUser()->getRaykuUserId();
    
    // whiteboard private sessions
    $cPrivate = new Criteria();
    $cPrivate->add(WhiteboardChatPeer::IS_PUBLIC, false);
    
    if ($expertId == $userId) {
      // my profile
      $cPrivateA = $cPrivate->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $userId);
      $cPrivateB = $cPrivate->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
      $cPrivateA->addOr($cPrivateB);    
      $cPrivate->add($cPrivateA);      
    }
    else {
      // other profile
      $cPrivate->add(WhiteboardChatPeer::EXPERT_ID, $expertId);
      $cPrivate->add(WhiteboardChatPeer::ASKER_ID, $userId);
    }
    
    $this->chat_list = WhiteboardChatPeer::doSelect($cPrivate);
  }
  
  /**
   * Executes show action
   *
   */ 
  public function executeShow()
  {    
    $request = $this->getRequest();

    // get params
    $chatId = $request->getParameter('id');    
    $userId = $this->getUser()->getRaykuUserId();
    
    // chat query & check access
    $criteria = new Criteria();
	  $criteria->add(WhiteboardChatPeer::ID, $chatId);
	  $cPublicA = $criteria->getNewCriterion(WhiteboardChatPeer::IS_PUBLIC, true);
	  $cPublicB = $criteria->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $userId);
    $cPublicC = $criteria->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
    $cPublicA->addOr($cPublicB);
    $cPublicA->addOr($cPublicC);
    $criteria->add($cPublicA);
    $chat = WhiteboardChatPeer::doSelectOne($criteria);    

    // messages query
    $msgCriteria = new Criteria();
	  $msgCriteria->add(WhiteboardMessagePeer::WHITEBOARD_CHAT_ID, $chatId);
	  $msgCriteria->addAscendingOrderByColumn(WhiteboardMessagePeer::CREATED_AT);
    $messages = WhiteboardMessagePeer::doSelect($msgCriteria);
  
    // snapshots query
    $snapCriteria = new Criteria();
	  $snapCriteria->add(WhiteboardSnapshotPeer::WHITEBOARD_CHAT_ID, $chatId);
	  $snapCriteria->addAscendingOrderByColumn(WhiteboardSnapshotPeer::CREATED_AT);
    $snapshots = WhiteboardSnapshotPeer::doSelect($snapCriteria);
  
    // assign variables to view
		$this->chat = $chat;
		$this->messages = $messages;
		$this->snapshots = $snapshots;
  }
  
  /**
   * Executes createChat action
   *
   */
  public function executeCreateChat()
  {
    $request = $this->getRequest();

    if ($request->isMethod('post')) {
    
      // get params
      $askerId = $request->getPostParameter('askerId');
      $expertId = $request->getPostParameter('expertId');
      $question = $request->getPostParameter('question');
      $askerNick = $request->getPostParameter('askerNick');
      $expertNick = $request->getPostParameter('expertNick');
      $chatSessionId = $request->getPostParameter('chatSessionId');
          
      // create new whiteboard chat
      $chat = new WhiteboardChat();
      $chat->setIsPublic(false);
      $chat->setAskerId($askerId);
      $chat->setExpertId($expertId);
      $chat->setAskerNickname($askerNick);
      $chat->setExpertNickname($expertNick);
      $chat->setQuestion($question);
      $chat->save();
    
      // chat directory
      $chat->setDirectory( $chat->getId() . '_' .  $chatSessionId );
      $chat->save();
    
      // json response
      $this->getResponse()->setContentType('application/json');
      $data_array = array( "chat_id" => $chat->getId() );
      $data_json = json_encode($data_array);
      
      return $this->renderText($data_json);
    }
  }
  
  /**
   * Executes logMessage action
   *
   */
  public function executeLogMessage()
  {
    $request = $this->getRequest();
    
    if ($request->isMethod('post')) {
      
      // post params
      $text = $request->getPostParameter('text');
      $userId = $request->getPostParameter('userId');
      $chatId = $request->getPostParameter('chat_id');

      $msg2 = new WhiteboardMessage();
      $msg2->setUserId($userId);
      $msg2->setMessage($text);
      $msg2->setWhiteboardChatId($chatId);
      $msg2->save();
    }
    
    return $this->renderText('');
  }  
  
  /**
   * Executes logSnapshot action
   *
   */
  public function executeLogSnapshot()
  {
    $request = $this->getRequest();

    if ($request->isMethod('post')) {

      // post params
      $chatId = $request->getPostParameter('chat_id');
      $filename = $request->getPostParameter('filename');      
        
      $snap = new WhiteboardSnapshot();
      $snap->setFilename($filename);
      $snap->setWhiteboardChatId($chatId);
      $snap->save();
    }
    
    return $this->renderText('');
  }
  
  /**
   * Executes startChat action
   *
   */
  public function executeStartChat()
  {
    $request = $this->getRequest();

    if ($request->isMethod('post')) {

      // post params
      $chatId = $request->getPostParameter('chat_id');
      
      $chatCriteria = new Criteria();
  	  $chatCriteria->add(WhiteboardChatPeer::ID, $chatId);
      $chat = WhiteboardChatPeer::doSelectOne($chatCriteria);
      $chat->setStartedAt(time());
      $chat->save();
    }
    
    return $this->renderText('');
  }
}
