<?php

/**
 * Subclass for representing a row from the 'group_user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GroupUser extends BaseGroupUser
{
  const TYPE_INVITED = 0;
  const TYPE_INVITED_LABEL = 'Invited';
  const TYPE_JOIN_REQUESTED = 1;
  const TYPE_JOIN_REQUESTED_LABEL = 'Join requested';
  const TYPE_MEMBER = 2;
  const TYPE_MEMBER_LABEL = 'Member';
  const TYPE_ADMIN = 3;
  const TYPE_ADMIN_LABEL = 'Admin';

	/**
	* Returns the user attached to userID
	* 
	* @return User
	*/
	public function getUser()
	{
		return parent::getUserRelatedByUserId();
	}
	
	/**
	* Returns the user attached to the inviterID
	* 
	* @return User
	*/
	public function getInviter()
	{
		return parent::getUserRelatedByInviterId();
	}
	
	/**
	* Figure out what the next user status is to be promoted to. Return false
	* if there isn't one.
	* 
	* @return string|bool
	*/
	public function getNextStatus()
	{
		$typeStatusMap = array(
      self::TYPE_JOIN_REQUESTED => self::TYPE_MEMBER,
      self::TYPE_MEMBER => self::TYPE_ADMIN,
      self::TYPE_ADMIN => self::TYPE_MEMBER,
      self::TYPE_INVITED => false );
		
		return $typeStatusMap[ $this->getStatus()];
	}
}
