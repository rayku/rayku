<?php

/**
 * Subclass for performing query and update operations on the 'bulletin' table.
 *
 * 
 *
 * @package lib.model
 */ 
class BulletinPeer extends BaseBulletinPeer
{
	/**
	* Clears all bulletins which have been around for longer than the time
	* allowed in config
	*/
	static public function clearExpiredBulletins()
	{
		$c = new Criteria();		
		$c->add(self::CREATED_AT, date('Y-m-d', time() - (sfConfig::get('app_bulletin_expiry_time') * 86400)), Criteria::LESS_EQUAL);

		//Delete 'em
		self::doDelete($c);
	}
}
