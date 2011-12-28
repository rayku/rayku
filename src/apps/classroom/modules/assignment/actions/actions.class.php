<?php
/**
 * assignment actions.
 *
 * @package    elifes
 * @subpackage assignment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class assignmentActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('assignment', 'list');
  }

  public function executeList()
  {
    $classroom = RaykuCommon::getCurrentClassroom( $this->getUser() );
    $this->forward404Unless( is_object( $classroom ) );
    $this->assignments = $classroom->getAssignments();
  }

  public function executeShow()
  {	
    $this->assignment = $this->getRequestedAssignment();
  }

  public function executeCreate()
  {
    $this->assignment = $this->createNewAssignment();
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->assignment = $this->getRequestedAssignment();
  }

  private function getRequestedAssignment()
  {
	  $assignment = AssignmentPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless(
            $assignment &&
            $assignment->getClassroom()->isUserOwnerOrMember( $this->getUser()->getRaykuUser() )
            );

    // when assignment was linked from other application we must be sure that current classroom is correctly set
    RaykuCommon::setCurrentClassroomId( $assignment->getClassroomId(),$this->getUser() );

    return $assignment;
  }

  private function createNewAssignment()
  {
    $assignment = new Assignment();
    $assignment->setClassroomId( RaykuCommon::getCurrentClassroomId( $this->getUser() ) );
    return $assignment;
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
      $assignment = $this->createNewAssignment();
    else
      $assignment = $this->getRequestedAssignment();


    $fileName = $this->getRequest()->getFileName('file');
    $uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'teachers_assignments';

    if($fileName != '')
    {
      $target = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
      $successfullyMoved = $this->getRequest()->moveFile('file', $target);
      if (!$successfullyMoved)
      {
        throw new Exception('Could not move uploaded file');
      }
    }

    $assignment->setTitle($this->getRequestParameter('title'));
    $assignment->setDescription($this->getRequestParameter('description'));
    $assignment->setFormat($this->getRequestParameter('format'));

    if($fileName == "")
    {
      if($assignment->getAttachments() != "")
      {
        $file=$assignment->getAttachments();
        $assignment->setAttachments($file);
      }
    }
    else
    {
      $assignment->setAttachments($fileName);
    }


    if( $this->getRequestParameter('due_date') )
    {
      list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('due_date'), $this->getUser()->getCulture());
      $assignment->setDueDate("$y-$m-$d");
    }

    $assignment->save();

    $c=new Criteria();
    $c->addJoin(UserPeer::ID,SubscriptionPeer::USER_ID,Criteria::JOIN);
    $c->add(SubscriptionPeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroomId( $this->getUser() ) );
    $c->add(SubscriptionPeer::NOTIFICATION_TYPE,1);

    $user=UserPeer::doSelect($c);

    foreach($user as $user1)
    {
      $this->mail = Mailman::createCleanMailer();
      //Set the to, from, and subject headers
      $this->mail->addAddress($user1->getEmail());
      $this->mail->setFrom('Teacher <'.$this->getUser()->getRaykuUser()->getEmail().'>');
      $this->mail->setSubject($this->getRequestParameter('title').'assignment');
      sfProjectConfiguration::getActive()->loadHelpers( array('Partial') );
      $this->mail->setBody( include_partial( 'updateEmail' ) );
      $this->mail->send();
    }

    return $this->redirect( 'assignment/show?id='.$assignment->getId() );
  }



  public function executeDelete()
  {
    $assignment = $this->getRequestedAssignment();
    $assignment->delete();
    return $this->redirect('assignment/list');
  }

  public function executeDeleteAttachment()
  {
    $assignment = $this->getRequestedAssignment();
	
    $assignment->setAttachments('');
    $assignment->save();
	
    return $this->redirect('assignment/edit?id=' . $assignment->getId() );
  }
}