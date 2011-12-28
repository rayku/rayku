<?php

/**
 * Subclass for performing query and update operations on the 'invitation' table.
 *
 * 
 *
 * @package lib.model
 */ 
class InvitationPeer extends BaseInvitationPeer
{
  static function countUserInvitations( User $user )
  {
    $c = new Criteria;
    $c->add( self::USER_ID, $user->getId() );
    return self::doCount($c);
  }

  static function hasUserInvitedEmail( User $user, $email )
  {
    $c = new Criteria();
    $c->add( InvitationPeer::RECEIVER_EMAIL, $email );
    $c->add( InvitationPeer::USER_ID, $user->getId() );
    $invitation = InvitationPeer::doSelectOne( $c );
    
    return $invitation instanceof Invitation;
  }
}
