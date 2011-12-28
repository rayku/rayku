<?php

/**
 * Subclass for performing query and update operations on the 'user_gift' table.
 *
 * 
 *
 * @package lib.model
 */ 
class UserGiftPeer extends BaseUserGiftPeer
{
  static function getGiftsReceivedBy(User $user)
  {
    $c = new Criteria;
    $c->add( self::USER_ID, $user->getId() );
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    $c->addJoin(self::GIFT_ID, GiftPeer::ID);
    $c->addJoin(self::GIVER_ID, UserPeer::ID);
    return self::doSelect($c);
  }
}
