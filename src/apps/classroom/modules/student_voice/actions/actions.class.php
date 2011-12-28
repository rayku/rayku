<?php
/**
 * student_voice actions.
 *
 * @package    elifes
 * @subpackage student_voice
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class student_voiceActions extends sfActions
{
  private function getRequestedStudentVoice()
  {
	  $voice = StudentVoicePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless(
            $voice &&
            $voice->getClassroom()->isUserOwnerOrMember( $this->getUser()->getRaykuUser() )
            );
    return $voice;
  }

  public function executeIndex()
  {
    return $this->forward('student_voice', 'list');
  }
  public function executeList()
  {
    $classroomId = RaykuCommon::getCurrentClassroomId( $this->getUser() );
    $this->latest_student_voices = StudentVoicePeer::getClassroomVoices( $classroomId );
    $this->popular_student_voices = StudentVoicePeer::getClassroomPopularVoices( $classroomId );
    $this->accepted_student_voices = StudentVoicePeer::getClassroomAcceptedVoices( $classroomId );
    StudentVoicePeer::fetchAdditionalInformations(
            array_merge(
                    $this->latest_student_voices,
                    $this->popular_student_voices,
                    $this->accepted_student_voices ),
            $this->getUser()->getRaykuUser() );
  }
  public function executeCreate()
  {
    $this->student_voice = $this->createNewStudentVoice();
    $this->setTemplate('edit');
  }

  private function createNewStudentVoice()
  {
    $studentVoice = new StudentVoice();
    $studentVoice->setUserId( $this->getUser()->getRaykuUserId() );
    $studentVoice->setClassroomId( RaykuCommon::getCurrentClassroomId( $this->getUser() ) );
    $studentVoice->setStatus( StudentVoice::STATUS_NOT_ACCEPTED );
    $studentVoice->setVote(1);
    return $studentVoice;
  }

  public function executeEdit()
  {
    $this->student_voice = $this->getRequestedStudentVoice();
  }
  public function executeUpdate()
  {
    if( $this->hasRequestParameter('id') &&
        is_numeric( $this->getRequestParameter('id') ) &&
        $this->getUser()->hasCredentials( 'student_voice_management' )
      )
    {
      $student_voice = $this->getRequestedStudentVoice();
    }
    else
    {
      $student_voice = $this->createNewStudentVoice();
    }
    $student_voice->setTitle($this->getRequestParameter('title'));
    $student_voice->setDescription($this->getRequestParameter('description'));

    $new = $student_voice->isNew();

    $student_voice->save();

    if( $new )
      $student_voice->addVoteFrom( $this->getUser()->getRaykuUser() );
    
    return $this->redirect('student_voice/list');
  }
  public function executeDeletevote()
  {
    $student_voice = $this->getRequestedStudentVoice();
    $student_voice->delete();
    return $this->redirect('student_voice/list');
  }
  public function executeAcceptvote()
  {
    $student_voice = $this->getRequestedStudentVoice();
    $student_voice->setStatus( StudentVoice::STATUS_ACCEPTED );
    $student_voice->save();
    return $this->redirect('student_voice/list');
  }
  public function executeVote()
  {
    $student_voice = $this->getRequestedStudentVoice();
    $user = $this->getUser()->getRaykuUser();
    
    if( $student_voice->hasVoteFrom( $user ) )
    {
      return $this->redirect('student_voice/voteexist');
    }
    else
    {
      $requestedVoteValue = $this->getRequestParameter('value');
      
      if( $requestedVoteValue < 0 )
        $requestedVoteValue = -1;
      else
        $requestedVoteValue = 1;
      
      $student_voice->addVoteFrom( $user, $requestedVoteValue );
    }
    
    return $this->redirect('student_voice/index');
  }
  public function executeVoteexist() {
  }
}
