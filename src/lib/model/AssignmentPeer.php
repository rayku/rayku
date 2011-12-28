<?php

/**
 * Subclass for performing query and update operations on the 'assignment' table.
 *
 * 
 *
 * @package lib.model
 */ 
class AssignmentPeer extends BaseAssignmentPeer
{
  static function getForClassroomsWithUserSubmissions($classrooms, User $user)
  {
    $classroomsIds = array();
    foreach( $classrooms as $classroom)
      $classroomsIds[] = $classroom->getId();

    $c = new Criteria;
    $c->addJoin( self::ID, SubmissionPeer::ASSIGNMENT_ID, Criteria::LEFT_JOIN );
    $cton = $c->getNewCriterion( SubmissionPeer::USER_ID, $user->getId() );
    $cton->addOr( $c->getNewCriterion( SubmissionPeer::USER_ID, null, Criteria::ISNULL ) );
    $c->add( self::CLASSROOM_ID, $classroomsIds, Criteria::IN );
    $c->addDescendingOrderByColumn(self::DUE_DATE);
    $c->addAscendingOrderByColumn(self::DUE_DATE);
    $c->add( self::DUE_DATE, time() - 86400*7, Criteria::GREATER_EQUAL);

    return self::doSelect($c);
  }

  static function getTeacherClassroomsAssignmentsForDashboard( User $teacher )
  {
    $c = new Criteria;
    $c->addJoin( self::CLASSROOM_ID, ClassroomPeer::ID );
    $c->add( ClassroomPeer::USER_ID, $teacher->getId() );
    $c->addDescendingOrderByColumn(self::DUE_DATE);
    $c->addAscendingOrderByColumn(self::DUE_DATE);
    $c->add( self::DUE_DATE, time() - 86400*7, Criteria::GREATER_EQUAL);
    return self::doSelect($c);
  }
}
