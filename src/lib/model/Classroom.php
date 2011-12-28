<?php

/**
 * Subclass for representing a row from the 'classroom' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Classroom extends BaseClassroom
{
  function isUserOwnerOrMember( User $user )
  {
    return $this->isUserOwner($user) || $this->isUserMember($user);
  }

  function isUserMember( User $user )
  {
    return $user->getType() == UserPeer::getTypeFromValue( 'user' ) &&
           ClassroomMembersPeer::isUserMemberOfClassroom( $user, $this );
  }

  function isUserOwner( User $user )
  {
    return $user->getType() == UserPeer::getTypeFromValue( 'teacher' ) &&
           $user->getId() == $this->getUserId();

  }

  function getBlogEntries()
  {
    $c = new Criteria;
    $c->addDescendingOrderByColumn( ClassroomBlogPeer::CREATED_AT );
    return $this->getClassroomBlogs( $c );
  }

  function getOwnerGallery()
  {
    $c = new Criteria;
    $c->add( GalleryPeer::CLASSROOM_ID, $this->getId() );
    $c->add( GalleryPeer::USER_ID, $this->getUserId() );
    return GalleryPeer::doSelectOne( $c );
  }
}
