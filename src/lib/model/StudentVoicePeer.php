<?php

/**
 * Subclass for performing query and update operations on the 'student_voice' table.
 * It also acts as cache trought web request life cycle
 *  * thanks to this we can reduce number of queries send to database
 *
 * @package lib.model
 */ 
class StudentVoicePeer extends BaseStudentVoicePeer
{
  /**
   * @var array holds sum of votes: $sumOfVotes[ STUDENT_VOICE_ID ]
   */
  private static $sumOfVotes = array();
  /**
   * @var array holds boolean flag about the fact that user has voted for voice:
   *      $userVoted[ STUDENT_VOICE_ID ][ USER_ID ]
   */
  private static $userVoted  = array();

  static function getClassroomVoices( $classroomId )
  {
    $c = new Criteria();
    $c->add( self::CLASSROOM_ID, $classroomId );
    $c->addDescendingOrderByColumn( self::CREATED_AT );

    return self::doSelectJoinUser( $c );
  }
  
  static function getClassroomPopularVoices( $classroomId )
  {
    $c = new Criteria();
    $c->add( self::CLASSROOM_ID, $classroomId);
    $c->add( self::STATUS, StudentVoice::STATUS_NOT_ACCEPTED );
    $c->addJoin( self::ID, StudentVoiceVotesPeer::STUDENT_VOICE_ID );
    $c->addGroupByColumn( self::ID );
    $c->addDescendingOrderByColumn('SUM( ' . StudentVoiceVotesPeer::VALUE . ' )');
    $c->setLimit( 5 );

    return self::doSelectJoinUser( $c );
  }

  static function getClassroomAcceptedVoices( $classroomId )
  {
    $c = new Criteria();
    $c->add( self::CLASSROOM_ID, $classroomId );
    $c->add( self::STATUS, StudentVoice::STATUS_ACCEPTED );
    return self::doSelectJoinUser( $c );
  }

  /**
   * Gets and remembers (in static properties) in two queries informations
   * for many $voices in context of $user (currently logged user in most cases)
   *
   * @param array $voices
   * @param User $user
   */
  static function fetchAdditionalInformations( $voices, User $user )
  {
    if( count( $voices ) < 1 )
      return;

    $voiceIds = array();
    foreach( $voices as $voice )
      $voiceIds[] = $voice->getId();

    array_unique($voiceIds);

    foreach( $voiceIds as $voiceId )
    {
      self::$userVoted[ $voiceId ][ $user->getId() ] = false;
      self::$sumOfVotes[ $voiceId ] = 0;
    }

    $c = new Criteria;
    $c->addSelectColumn( StudentVoiceVotesPeer::STUDENT_VOICE_ID );
    $c->add( StudentVoiceVotesPeer::STUDENT_VOICE_ID, $voiceIds, Criteria::IN );
    $c->add( StudentVoiceVotesPeer::USER_ID, $user->getId() );
    $stmt = StudentVoiceVotesPeer::doSelectStmt( $c );
    while( $row = $stmt->fetch() )
      self::$userVoted[ $row[0] ][ $user->getId() ] = true;


    $query = "SELECT student_voice_id, SUM( value ) total_value FROM student_voice_votes WHERE student_voice_id IN (" . join(',', $voiceIds ) . ") GROUP BY student_voice_id";
    $stmt = Propel::getConnection(self::DATABASE_NAME)->query($query);
    if( $stmt->rowCount() > 0 )
    {
      while( $row = $stmt->fetch() )
        self::$sumOfVotes[ $row['student_voice_id'] ] = $row['total_value'];
    }
  }

  static function hasVoteFrom( StudentVoice $voice, User $user )
  {
    if( isset( self::$userVoted[ $voice->getId() ] ) &&
        isset( self::$userVoted[ $voice->getId() ][ $user->getId() ] ) )
      return self::$userVoted[ $voice->getId() ][ $user->getId() ];

    $c = new Criteria;
    $c->add( StudentVoiceVotesPeer::USER_ID, $user->getId() );
    $c->add( StudentVoiceVotesPeer::STUDENT_VOICE_ID, $voice->getId() );
    $votes = StudentVoiceVotesPeer::doSelect( $c );

    self::$userVoted[ $voice->getId() ][ $user->getId() ] = count( $votes ) > 0;

    return self::$userVoted[ $voice->getId() ][ $user->getId() ];
  }

  static function getSumOfVotes( StudentVoice $voice )
  {
    if( isset( self::$sumOfVotes[ $voice->getId() ] ) )
      return self::$sumOfVotes[ $voice->getId() ];
    

    $query = "SELECT SUM( value ) total_value FROM student_voice_votes WHERE student_voice_id = " . $voice->getId() . " GROUP BY student_voice_id";
    $stmt = Propel::getConnection( self::DATABASE_NAME )->query($query);
    if( $stmt->rowCount() == 1 )
    {
      $row = $stmt->fetch();
      self::$sumOfVotes[ $voice->getId() ] = $row['total_value'];
    }
    else
      self::$sumOfVotes[ $voice->getId() ] = 0;

    return self::$sumOfVotes[ $voice->getId() ];
  }
}
