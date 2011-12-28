<?php

/**
 * Subclass for performing query and update operations on the 'group_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GroupUserPeer extends BaseGroupUserPeer
{
	/**
	* Clears all expired group invitations
	*/
	static public function clearExpiredInvitations()
	{
		$c = new Criteria();

		//Grab all invited people where the invitation was created 
		//request_expiry_time days ago
		$c->add(self::STATUS, GroupUser::TYPE_INVITED );
		$c->add(self::CREATED_AT, date('Y-m-d', time() - (sfConfig::get('app_group_request_expiry_time') * 86400)), Criteria::LESS_EQUAL);

		//Delete 'em
		self::doDelete($c);
	}
}
