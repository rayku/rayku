<?php

/**
 * Subclass for performing query and update operations on the 'gallery_item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GalleryItemPeer extends BaseGalleryItemPeer
{
  static function getLastUsersItems( $userIds, $limit = 10 )
  {
    $c = new Criteria();
    $c->addJoin(self::GALLERY_ID, GalleryPeer::ID );
    $c->add(GalleryPeer::USER_ID, $userIds, Criteria::IN);
    $c->addDescendingOrderByColumn(self::CREATED_AT);
    $c->setLimit( $limit );

    return self::doSelect( $c );
  }
}
