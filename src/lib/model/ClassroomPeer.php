<?php

/**
 * Subclass for performing query and update operations on the 'classroom' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ClassroomPeer extends BaseClassroomPeer
{
  static function getForStudentManager( $user )
  {
    $c = new Criteria();
		$c->add( ClassroomMembersPeer::USER_ID, $user->getId() );
		$c->add( ClassroomMembersPeer::APPROVED, 1 );
    $c->addJoin( ClassroomMembersPeer::CLASSROOM_ID, ClassroomPeer::ID );

    return ClassroomPeer::doSelect($c);
  }

  static function getForCategoryAndTeacher( $iCategoryId, $iTeacherId )
  {
  	$c = new Criteria();
		$c->add( ClassroomPeer::CATEGORY_ID, $iCategoryId );
		$c->add( ClassroomPeer::USER_ID, $iTeacherId );

    return ClassroomPeer::doSelect($c);
  }

  static function search( $classroom_search )
  {
    $c = new Criteria();

    $cton = $c->getNewCriterion(ClassroomPeer::FULLNAME, '%'.$classroom_search.'%', Criteria::LIKE);
    $cton->addOr($c->getNewCriterion(ClassroomPeer::SHORTNAME, '%'.$classroom_search.'%', Criteria::LIKE));
    $cton->addOr($c->getNewCriterion(ClassroomPeer::LOCATION, '%'.$classroom_search.'%', Criteria::LIKE));
    $cton->addOr($c->getNewCriterion(ClassroomPeer::SCHOOL_NAME, '%'.$classroom_search.'%', Criteria::LIKE));

    $c->add($cton);

    return ClassroomPeer::doSelect($c);
  }
}
