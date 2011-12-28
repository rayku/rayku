<?php

/**
 * Subclass for performing query and update operations on the 'subscription' table.
 *
 * 
 *
 * @package lib.model
 */ 
class SubscriptionPeer extends BaseSubscriptionPeer
{
  static function getForUser( $user )
  {
    $c = new Criteria();
    $c->add(SubscriptionPeer::USER_ID, $user->getId() ) ;

    return self::doSelect( $c );
  }

  static function getFor( $iStype, $iUserId, $iClassId )
  {
    $c = new Criteria();
    $c->add(SubscriptionPeer::NOTIFICATION_TYPE, $iStype);
    $c->add(SubscriptionPeer::USER_ID, $iUserId);
    $c->add(SubscriptionPeer::CLASSROOM_ID, $iClassId);

    return SubscriptionPeer::doSelectOne($c);
  }
}
