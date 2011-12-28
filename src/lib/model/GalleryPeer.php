<?php

/**
 * Subclass for performing query and update operations on the 'gallery' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GalleryPeer extends BaseGalleryPeer
{
	public static function findGalleriesForUser($user)
	{
		$c = new Criteria();
		$c->add(self::USER_ID, $user->getId());
		$c->addAscendingOrderByColumn(self::TITLE);
		
		return self::doSelect($c);
	}
}
