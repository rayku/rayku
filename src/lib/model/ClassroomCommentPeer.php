<?php

/**
 * Subclass for performing query and update operations on the 'classroom_comment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ClassroomCommentPeer extends BaseClassroomCommentPeer
{

  static function getLastUsersComments( $userIds, $limit = 10 )
  {
    $c = new Criteria();
    $c->add(self::USER_ID, $userIds, Criteria::IN );
    $c->addDescendingOrderByColumn( self::POSTED_AT );
    $c->setLimit( $limit );

    return self::doSelect( $c );
  }
}
