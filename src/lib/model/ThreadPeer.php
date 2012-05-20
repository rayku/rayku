<?php

/**
 * Subclass for performing query and update operations on the 'thread' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ThreadPeer extends BaseThreadPeer
{
  static function getLastUsersThreads( $userIds, $limit = 10 )
  {
    $c = new Criteria();
    $c->add( self::POSTER_ID, $userIds, Criteria::IN );
    $c->addDescendingOrderByColumn( self::CREATED_AT );
    $c->setLimit( $limit );
    return self::doSelect( $c );
  }

  static function getCountOfCreatedThreadsForUser( $user )
  {
    $c = new Criteria();
    $c->add(ThreadPeer::POSTER_ID, $user->getId());
    return ThreadPeer::doCount($c);
  }

  static function getCriteriaForCategory( $category_id )
  {
    $c = new Criteria();
		$c->add(ThreadPeer::CATEGORY_ID, $category_id);
		$c->addDescendingOrderByColumn(ThreadPeer::LASTPOST_AT);
		$c->add(ThreadPeer::CANCEL, 0);

    return $c;
  }
}
