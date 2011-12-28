<?php

/**
 * Subclass for performing query and update operations on the 'experts_lesson_members' table.
 *
 * 
 *
 * @package lib.model
 */ 
class ExpertsLessonMembersPeer extends BaseExpertsLessonMembersPeer
{
  static function isUserMemberOfLesson( User $user, ExpertLesson $lesson )
  {
    $c = new Criteria;
    $c->add( self::LESSON_ID, $lesson->getId() );
    $c->add( self::STUDENT_ID, $user->getId() );

    return self::doCount( $c ) == 1;
  }
}
