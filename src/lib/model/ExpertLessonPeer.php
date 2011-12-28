<?php

/**
 * Subclass for performing query and update operations on the 'expert_lesson' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ExpertLessonPeer extends BaseExpertLessonPeer
{
  static function getForStudent( $user )
  {
		$c = new Criteria();
		$c->add( ExpertsLessonMembersPeer::STUDENT_ID, $user->getId() );
    $c->addJoin( ExpertsLessonMembersPeer::LESSON_ID, ExpertLessonPeer::ID );

		return ExpertLessonPeer::doSelect($c);
  }

  static function getForExpert( $iUserId )
  {
    $c = new Criteria();
		$c->add(ExpertLessonPeer::USER_ID, $iUserId);

    return ExpertLessonPeer::doSelect($c);
  }
}
