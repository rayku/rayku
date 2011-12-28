<?php

/**
 * Subclass for performing query and update operations on the 'classroom_members' table.
 *
 *
 *
 * @package lib.model
 */
class ClassroomMembersPeer extends BaseClassroomMembersPeer
{
  static function getTeacherStudentIds( User $teacher )
  {
    $c = new Criteria();
    $c->addJoin( ClassroomMembersPeer::CLASSROOM_ID, ClassroomPeer::ID, Criteria::JOIN );
    $c->add(ClassroomPeer::USER_ID, $teacher->getId());

    $classroomStudentIds = array();

    foreach( ClassroomMembersPeer::doSelect($c) as $classroomMember )
    {
      $classroomStudentIds[ $classroomMember->getUserId() ] = true;
    }

    return array_keys( $classroomStudentIds );
  }

  static function getFor( $iUserId, $iCategoryId, $iClassId )
  {
    $c = new Criteria();
		$c->add( ClassroomMembersPeer::USER_ID, $iUserId );
		$c->add( ClassroomMembersPeer::CATEGORY_ID, $iCategoryId );
		$c->add( ClassroomMembersPeer::CLASSROOM_ID, $iClassId );

    return self::doSelectOne( $c );
  }

  static function isUserMemberOfClassroom( User $user, Classroom $classroom )
  {
    $c = new Criteria;
    $c->add( self::CLASSROOM_ID, $classroom->getId() );
    $c->add( self::USER_ID, $user->getId() );

    return self::doCount( $c ) == 1;
  }

  static function isUserApprovedMemberOfClassroom( User $user, Classroom $classroom )
  {
    $c = new Criteria();
    $c->add( self::CLASSROOM_ID, $classroom->getId() );
		$c->add( self::USER_ID, $user->getId() );
		$c->add( self::APPROVED, '1');

    return self::doCount( $c ) == 1;
  }
}
