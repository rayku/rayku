<?php

/**
 * Subclass for representing a row from the 'student_voice' table.
 *
 * 
 *
 * @package lib.model
 */ 
class StudentVoice extends BaseStudentVoice implements HistoricalObjectI
{
  const STATUS_NOT_ACCEPTED = 0;
  const STATUS_ACCEPTED = 1;

	public function save(PropelPDO $con = null)
	{
    $new = $this->isNew();

    $ret = parent::save($con);

    if( $new )
      HistoryPeer::createFor($this);

    return $ret;
	}

  public function getDataForHistory()
  {
    return new HistoricalObjectEntry( $this->getUserId(), array( 'student_voice_id' => $this->getId(), 'title' => $this->getTitle() ) );
  }

  public static function renderForHistory( HistoricalObjectEntry $historyEntryData )
  {
    $data = $historyEntryData->getData();

    $userLink = $historyEntryData->getUserLink();

    return "$userLink creted student voice record titled " . link_to( $data['title'], 'student_voice/show?id=' . $data['student_voice_id'] );
  }

  function addVoteFrom( User $user, $voteValue = 1 )
  {
    $vote = new StudentVoiceVotes();
    $vote->setUser( $user );
    $vote->setStudentVoice( $this );
    $vote->setValue( $voteValue );
    $vote->save();

    return $vote;
  }

  function hasVoteFrom( User $user )
  {
    return StudentVoicePeer::hasVoteFrom( $this, $user );
  }

  function getSumOfVotes()
  {
    return StudentVoicePeer::getSumOfVotes( $this );
  }
}
