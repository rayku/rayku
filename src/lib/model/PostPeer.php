<?php

/**
 * Subclass for performing query and update operations on the 'post' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PostPeer extends BasePostPeer
{
	/**
	 * return the string to appear in the history
	 *
	 * @param Post $post
	 * @return string
	 */
	static public function toHistoryString($post)
	{
		$controller = sfContext::getInstance()->getController();
		$link = $controller->genUrl('@view_thread?thread_id=' . $post->getThreadId());
		
		$link = sprintf(
			'<a href="%s">%s</a>',
			$link,
			'forum thread'
		);
		
		return sprintf(
			'posted on a %s',
			$link
		);
	}

  static function search( $criteria )
  {
    $c = new Criteria;

    $c->addSelectColumn(self::ID . ' ID');
    $c->addSelectColumn(ThreadPeer::TITLE . ' NAME');
    $c->addSelectColumn(self::CONTENT . ' DESCRIPTION');
    $tableName = self::TABLE_NAME;
    $c->addSelectColumn( "'$tableName' TNAME" );

    $c->addJoin( self::THREAD_ID, ThreadPeer::ID );
    $cton1 = $c->getNewCriterion( self::CONTENT, "%$criteria%", Criteria::LIKE );

    $cton2 = $c->getNewCriterion(ThreadPeer::TITLE, '%'.$criteria.'%', Criteria::LIKE);
    $cton2->addOr($c->getNewCriterion(ThreadPeer::TAGS, '%'.$criteria.'%', Criteria::LIKE));
    $cton1->addOr( $cton2 );
    
    $c->add( $cton1 );

    return self::doSelectStmt($c);
  }

  static function getFirstForThreadId( $thread_id )
  {
    $c = new Criteria();
    $c->add(PostPeer::THREAD_ID, $thread_id);
    $c->addAscendingOrderByColumn(PostPeer::ID);
    $c->setLimit(1);
    return PostPeer::doSelectOne($c);
  }

  static function getForThreadIdAndFor($thread_id, $post_id, $bEkpsert, $bBestResponse)
  {
		$c = new Criteria();
		$c->add(PostPeer::THREAD_ID, $thread_id);
    $c->add(PostPeer::ID, $post_id, Criteria::NOT_EQUAL);
    $c->add(PostPeer::BEST_RESPONSE, $bBestResponse);
		$c->addAscendingOrderByColumn(PostPeer::UPDATED_AT);
    $c->addJoin(PostPeer::POSTER_ID,UserPeer::ID,Criteria::JOIN);
    if( $bEkpsert )
		  $c->add(UserPeer::TYPE, 5);
    else
      $c->add(UserPeer::TYPE,'5',Criteria::NOT_EQUAL);
    
		return PostPeer::doSelect( $c );
  }

  static function getForThreadIdAnd($thread_id, $post_id)
  {
		$c = new Criteria();
		$c->add(PostPeer::THREAD_ID, $thread_id);
    $c->add(PostPeer::ID, $post_id, Criteria::NOT_EQUAL);
 $c->add(PostPeer::BEST_RESPONSE, 0);
		$c->addAscendingOrderByColumn(PostPeer::UPDATED_AT);
    $c->addJoin(PostPeer::POSTER_ID,UserPeer::ID,Criteria::JOIN);
      
	return PostPeer::doSelect( $c );
  }


  static function getCountOfBestResponseForExpert( $expert )
  {
    $c = new Criteria();
    $c->add(PostPeer::POSTER_ID, $expert->getId());
    $c->add(PostPeer::BEST_RESPONSE, 1);
    return PostPeer::doCount($c);
  }

  static function getCountOfBestResponseForThread( $thread )
  {
    $c = new Criteria();
    $c->add(PostPeer::THREAD_ID, $thread->getId() );
    $c->add(PostPeer::BEST_RESPONSE, 1);
    return PostPeer::doCount($c);
  }

  static function getCountOfRepliesForUser( $user )
  {
    $c = new Criteria();
    $c->add(PostPeer::POSTER_ID, $user->getId());
    return PostPeer::doCount($c);
  }

  static function getCountOfBestResponseForCreatedThreadsByUser( $user )
  {
    $c = new Criteria();
    $c->add(ThreadPeer::POSTER_ID,$user->getId());
    $c->addJoin(PostPeer::THREAD_ID,ThreadPeer::ID,Criteria::JOIN);
    $c->add(PostPeer::BEST_RESPONSE, 1);
    return PostPeer::doCount($c);
  }

  static function getCountForThread( Thread $thread )
  {
    $c = new Criteria;
    $c->add( self::THREAD_ID, $thread->getId());
    return self::doCount($c);
  }

}
