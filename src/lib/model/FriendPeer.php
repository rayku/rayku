<?php

/**
 * Subclass for performing query and update operations on the 'friend' table.
 *
 * 
 *
 * @package lib.model
 */ 
class FriendPeer extends BaseFriendPeer
{
	/**
	* Clears all expired friend invitations
	*/
	static public function clearExpiredInvitations()
	{
		$c = new Criteria();

		//Grab all friend invitations from request_expiry_time days ago
		$c->add(self::STATUS, Friend::TYPE_FRIEND_REQUEST_SENT );
		$c->add(self::CREATED_AT, date('Y-m-d', time() - (sfConfig::get('app_friends_request_expiry_time') * 86400)), Criteria::LESS_EQUAL);

		self::doDelete($c);
	}


  static function getFriendsOf( User $user )
  {

    $c = self::getCriteriaForFriendsFor($user);
	
    UserPeer::addActiveUserCriteria($c);


    return UserPeer::doSelect( $c);
  }

  static function getCriteriaForRequestees( $user )
  {
    $c = new Criteria();
    $c->add( FriendPeer::STATUS, 0 );
    $c->add( FriendPeer::USER_ID1, $user->getId() );
    $c->addJoin( FriendPeer::USER_ID2, UserPeer::ID );

    return $c;
  }

	/**
	* 
	*
	* @param User $user
	* @return Criteria
	*/
  static function getCriteriaForFriendsFor( $user )
  {
    $c = new Criteria();
    $c->add( FriendPeer::STATUS, 1 );

    $cton1 = $c->getNewCriterion( FriendPeer::USER_ID1, $user->getId() );
    $cton1->addAnd( $c->getNewCriterion( FriendPeer::USER_ID1, UserPeer::ID . ' = ' . FriendPeer::USER_ID2, Criteria::CUSTOM ) );
    $cton2 = $c->getNewCriterion( FriendPeer::USER_ID2, $user->getId() );
    $cton2->addAnd( $c->getNewCriterion( FriendPeer::USER_ID2, UserPeer::ID . ' = ' . FriendPeer::USER_ID1, Criteria::CUSTOM ) );

    $cton1->addOr($cton2);
    $c->add($cton1);

    return $c;
  }

	/**
	* 
	*
	* @param User $user
	* @return Criteria
	*/
  static function getCriteriaForRequesters( $user )
  {
    $c = new Criteria();
    $c->add( FriendPeer::STATUS, 0 );
    $c->add( FriendPeer::USER_ID2, $user->getId() );
    $c->addJoin( FriendPeer::USER_ID1, UserPeer::ID );

    return $c;
  }

  /**
   * No one likes to be alone so for new users we will make him friend of kinkarso user
   *
   * @param User $user
   */
  static function createInitialFriendship( User $user )
  {
    
	$c= new Criteria();
	$c->add(UserPeer::USERNAME,RaykuCommon::SITE_USER_USERNAME);
	$kinkarsoUser=UserPeer::doSelectOne($c);
	
//	$kinkarsoUser = UserPeer::getByUsername( RaykuCommon::SITE_USER_USERNAME );
    
	
	if( $kinkarsoUser )
    {
      $kinkarsoUser->requestFriendshipFrom($user, true);
      $user->respondToFriendshipRequestFrom( $kinkarsoUser, true );
    }

    return $kinkarsoUser;
  }
}
