<?php

/**
 * Subclass for representing a row from the 'assignment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Assignment extends BaseAssignment
{
  function getSubmissionOf( User $user )
  {
    $c = new Criteria;
    $c->add( SubmissionPeer::ASSIGNMENT_ID, $this->getId() );
    $c->add( SubmissionPeer::USER_ID, $user->getId() );
    return SubmissionPeer::doSelectOne( $c );
  }
}
