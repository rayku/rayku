<?php
/**
 * submission actions.
 *
 * @package    elifes
 * @subpackage submission
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */

class submissionActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('submission', 'list');
  }

  public function executeList()
  {
    $assignment = AssignmentPeer::retrieveByPk($this->getRequestParameter('assignmentid'));
    $this->forward404Unless( $assignment->getClassroom()->isUserOwner( $this->getUser()->getRaykuUser() ) );

    $this->assignment = $assignment;
  }

  public function executeShow()
  {
    $submission = SubmissionPeer::retrieveByPk( $this->getRequestParameter('id') );
	  $this->forward404Unless( $submission && $submission->canBeWatchedBy( $this->getUser()->getRaykuUser() ) );

    $this->submission = $submission;
  }

  public function executeCreate()
  {
    $this->submission = $this->createNewSubmission( $this->getRequestedAssignment() );
    $this->setTemplate('edit');
  }


  public function executeEdit()
  {
    $submission = SubmissionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless( $submission->canBeEditedBy( $this->getUser()->getRaykuUser() ) );
    
    $this->submission = $submission;
  }



  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
      $submission = $this->createNewSubmission( $this->getRequestedAssignment() );
    else
    {
      $submission = SubmissionPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless( $submission && $submission->canBeEditedBy( $this->getUser()->getRaykuUser() ) );
    }


    $fileName = $this->getRequest()->getFileName('path');

    if($fileName)
    {
      $this->getRequest()->moveFile('path', sfConfig::get('sf_upload_dir').'/'.$fileName);
      $submission->setPath($fileName);
    }

    $submission->setData($this->getRequestParameter('data'));
    $submission->save();

    return $this->redirect('submission/show?id='.$submission->getId());
  }

  public function executeDelete()
  {
    $submission = SubmissionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless( $submission && $submission->canBeEditedBy( $this->getUser()->getRaykuUser() ) );
    $submission->delete();
    return $this->redirect('submission/list?assignmentid=' . $submission->getAssignmentId() );
  }

  public function executeDownload()
  {
	   $submission = SubmissionPeer::retrieveByPk( $this->getRequestParameter('id') );
	   $this->forward404Unless( $submission && $submission->canBeWatchedBy( $this->getUser()->getRaykuUser() ) );

	   header("Content-type: application/force-download");
     header('Content-Disposition: inline; filename="' . sfConfig::get('sf_upload_dir').'/'.$submission->getPath(). '"');
     header("Content-Transfer-Encoding: Binary");
     header("Content-length: ".filesize(sfConfig::get('sf_upload_dir').'/'.$submission->getPath()));
     header('Content-Type: application/octet-stream');
     header('Content-Disposition: attachment; filename="' . $submission->getPath() . '"');
     readfile(sfConfig::get('sf_upload_dir').'/'.$submission->getPath());

	   return $this->redirect('submission/show?id='.$this->getRequestParameter('file'));
  }

  public function executeApprove()
  {
  	$submission = SubmissionPeer::retrieveByPk($this->getRequestParameter('id'));
		$this->forward404Unless(
            $submission &&
            $submission->getAssignment()->getClassroom()->isUserOwner( $this->getUser()->getRaykuUser() ) );

		$submission->setApproved(1);
		$submission->save();

		return $this->redirect('submission/list?assignmentid='.$submission->getAssignmentId());
  }

  public function executeAssigngrade()
  {
  	$submission = SubmissionPeer::retrieveByPk($this->getRequestParameter('id'));
		$this->forward404Unless(
            $submission &&
            $submission->getAssignment()->getClassroom()->isUserOwner( $this->getUser()->getRaykuUser() ) );

		$submission->setGrade($this->getRequestParameter('grade'));
		$submission->save();

		return $this->redirect('submission/list?assignmentid='.$submission->getAssignmentId());
  }

  public function executeComment()
  {
  	$submission = SubmissionPeer::retrieveByPk($this->getRequestParameter('id'));
		$this->forward404Unless(
            $submission &&
            $submission->getAssignment()->getClassroom()->isUserOwner( $this->getUser()->getRaykuUser() ) );

		$submission->setComment($this->getRequestParameter('comment'));
		$submission->save();

		return $this->redirect('submission/list?assignmentid='.$submission->getAssignmentId());
  }

  private function getRequestedAssignment()
  {
    $raykuUser = $this->getUser()->getRaykuUser();
    $assignment = AssignmentPeer::retrieveByPK( $this->getRequestParameter( 'assignmentid') );
    $this->forward404Unless( $assignment && $assignment->getClassroom()->isUserOwnerOrMember( $raykuUser ) );
    return $assignment;
  }
  
  private function createNewSubmission( Assignment $assignment )
  {
    $submission = new Submission();
    $submission->setAssignment( $assignment );
    $submission->setUser( $this->getUser()->getRaykuUser() );
    return $submission;
  }
  
}
