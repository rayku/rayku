<?php

/**
 * Subclass for representing a row from the 'submission' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Submission extends BaseSubmission
{
  function canBeEditedBy( User $user )
  {
    return $this->getApproved() == 0 &&
           $user->getType() == UserPeer::getTypeFromValue('user') &&
           $user->getId() == $this->getUserId() &&
           ( is_null( $this->getAssignment()->getDueDate( 'U' ) ) ||
             $this->getAssignment()->getDueDate( 'U' ) > time() );
  }

  function canBeWatchedBy( User $user )
  {
    if( $user->getType() == UserPeer::getTypeFromValue( 'user' ) )
      return $user->getId() == $this->getUserId();
    else if( $user->getType() == UserPeer::getTypeFromValue( 'teacher' ) )
      return $this->getAssignment()->getClassroom()->isUserOwner($user);
  }
}
