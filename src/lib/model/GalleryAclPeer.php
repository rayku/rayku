<?php

/**
 * Subclass for performing query and update operations on the 'gallery_acl' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GalleryAclPeer extends BaseGalleryAclPeer
{
  static function getSpecyficPeopleForGalleryForSelect($galleryId)
  {
    $c = new Criteria();
    $c->add(self::GALLERY_ID, $galleryId);
    $galleryAcl = self::doSelect($c);

    $gallery_friend = array();
    foreach($galleryAcl as $gallery)
    {
      $gallery_friend[] = $gallery->getUserId();
    }

    return $gallery_friend;
  }
}
