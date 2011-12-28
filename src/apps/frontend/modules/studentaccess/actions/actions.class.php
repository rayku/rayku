<?php

/**
 * studentaccess actions.
 *
 * @package    elifes
 * @subpackage studentaccess
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class studentaccessActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
  }
   
  public function executeJoin()
  {
    $iCategoryId = $this->getRequestParameter('category');
    $iTeacherId = $this->getRequestParameter('teacher');

    $this->categories = CategoryPeer::doSelect( new Criteria() );
  	$this->alluser = UserPeer::getForClassroomCategory( $iCategoryId );
    $this->allclassroom = ClassroomPeer::getForCategoryAndTeacher( $iCategoryId, $iTeacherId );
    
    if( $this->getRequest()->isXmlHttpRequest() )
    {
  		sfProjectConfiguration::getActive()->loadHelpers('Partial');
      
      return $this->renderText(
        get_partial( 'selects', array( 'categories' => $this->categories,
                                       'alluser' => $this->alluser,
                                       'allclassroom' => $this->allclassroom )
        )
      );
    }
  }

  public function executeJoinLesson()
  {
    $this->userid = $this->getRequestParameter('expert') ;
		$this->catid = $this->getRequestParameter('category') ;
		$this->lessid = $this->getRequestParameter('lesson');

		$this->categories = CategoryPeer::doSelect(new Criteria());
    $this->alluser = UserPeer::getForExpertCategory( $this->catid );
    $this->allclassroom = ExpertLessonPeer::getForExpert( $this->userid );
  }

  public function executeSendMail()
  {
    //Teacher or Expert
    $iUserId = $this->getRequestParameter('userid');
    $iCategoryId = $this->getRequestParameter('catid');

    //Join Teachers Classroom
    $iClassroomId = $this->getRequestParameter('classid');

    //Join Experts Lessons
    $iLessonId = $this->getRequestParameter('lessid');

		$this->user = UserPeer::retrieveByPK( $iUserId );
		$this->category = CategoryPeer::retrieveByPK( $iCategoryId );
		$this->classroom = ClassroomPeer::retrieveByPK( $iClassroomId );
		$this->lesson = ExpertLessonPeer::retrieveByPK( $iLessonId );

    if( !$this->user instanceof User || !$this->category instanceof Category )
    {
      $this->error = 'Error';
      return sfView::ERROR ;
    }

    if( $iClassroomId != '' || $iLessonId != '' )
    {
      //Join Teachers Classroom
      if( $iClassroomId != '')
      {
        if( !$this->classroom instanceof Classroom )
        {
          $this->error = 'Error';
          return sfView::ERROR ;
        }

        if( ClassroomMembersPeer::isUserApprovedMemberOfClassroom( $this->getUser()->getRaykuUser(), $this->classroom ) )
        {
          $this->error = 'You are already a member of this classroom. Please select the other classroom!';
          return sfView::ERROR ;
        }

        if( ClassroomMembersPeer::isUserMemberOfClassroom( $this->getUser()->getRaykuUser(), $this->classroom ) )
        {
          $this->error = 'You have already send request for joining to the classroom. You should wait for answer.';
          return sfView::ERROR ;
        }

        $classroommember = new ClassroomMembers();
        $classroommember->setUserId( $this->getUser()->getRaykuUserId() );
        $classroommember->setCategoryId( $iCategoryId );
        $classroommember->setClassroomId( $iClassroomId );
        $classroommember->setApproved('0');
        $classroommember->save();

        $this->sendMail( $this->user, $this->category, $this->classroom );
      }
      elseif( $iLessonId != '' )//Join Experts Lessons
      {
        if( !$this->lesson instanceof ExpertLesson )
        {
          $this->error = 'Error';
          return sfView::ERROR ;
        }

        if( ExpertsLessonMembersPeer::isUserMemberOfLesson( $this->getUser()->getRaykuUser(), $this->lesson ) )
        {
          $this->error = 'You are already a member of this lesson. Please select the other lesson!';
          return sfView::ERROR ;
        }

        $lessonmemeber = new ExpertsLessonMembers();
        $lessonmemeber->setStudentId($this->getUser()->getRaykuUserId());
        $lessonmemeber->setCategoryId( $iCategoryId );
        $lessonmemeber->setExpertId( $iUserId );
        $lessonmemeber->setLessonId( $iLessonId );
        $lessonmemeber->setApprove('0');
        $lessonmemeber->save();
      }
    }
  }

  private function sendMail( $user, $category, $classroom )
  {
    $oRaykuUser = $this->getUser()->getRaykuUser();

    $this->mail = Mailman::createCleanMailer();
    $this->mail->addAddress( $user->getEmail() );
    $this->mail->setFrom('Student <'.$oRaykuUser->getEmail().'>');
    $this->mail->setSubject('Wants to joined to "'.$classroom->getFullName().'" classroom');

    sfProjectConfiguration::getActive()->loadHelpers(array('Url','Partial'));
    $this->mail->setBody(
      get_partial( 'joinRequestEmail', array(
                      'activationLink' => url_for( '/studentmanager/confirmStudent?userid='.$oRaykuUser->getId().
                               '&catid='.$category->getId().
                               '&classid='.$classroom->getId().
                               '&confirmationcode='.UserPeer::generateConfirmationStudentHash( $oRaykuUser, $classroom->getId() ), true ),
                      'teacher'   => $user,
                      'classroom' => $classroom,
                      'category'  => $category
                    )
      )
    );

    $this->mail->send();
  }

  public function executeWriteMail()
  {
    $iClassroomId = $this->getRequestParameter('classroom');
    $iTeacherId = $this->getRequestParameter('teacher');

		$this->allclassroom = ClassroomPeer::getForStudentManager( $this->getUser()->getRaykuUser() );

 		if( $iClassroomId != '' )
    {
      $this->user = UserPeer::getForClassroom( $iClassroomId );

      if( !$this->user instanceof User )
      {
        $this->setTemplate( 'sendMail' );
        $this->error = 'Error';
        return sfView::ERROR;
      }
		}

		if( $iTeacherId != '')
    {
      $subject = $this->getRequestParameter('subject');
      $body = str_replace('&nbsp;', '', strip_tags( $this->getRequestParameter('bodycontent') ) );
      $user = UserPeer::retrieveByPK( $iTeacherId );
      
      $this->sendMailToTeacher( $user, $subject, $body );

      return $this->redirect('studentaccess/mailSent');
		}
  }

  private function sendMailToTeacher( $user, $subject, $body )
  {
    $this->mail = Mailman::createCleanMailer();

    //Set the to, from, and subject headers
    $this->mail->addAddress( $user->getEmail() );
    $this->mail->setFrom('Student <'.$this->getUser()->getRaykuUser()->getEmail().'>');
    $this->mail->setSubject( $subject );
    $this->mail->setBody( $body );

    $this->mail->send();
  }

  public function executeMailSent()
  {
  }

  public function executeNotifications()
  {
    $iUserId = $this->getRequestParameter('userid');
    $user = UserPeer::retrieveByPK( $iUserId );

    if( !$user instanceof User)
    {
      return sfView::ERROR;
    }

    $this->classroom = ClassroomPeer::getForStudentManager( $user  );
    $this->subscription = SubscriptionPeer::getForUser( $user );
  }

  public function executeSubscribe()
  {
    $iStype = $this->getRequestParameter('stype');
    $iUserId = $this->getRequestParameter('userid');
    $iClassId = $this->getRequestParameter('classid');

    $user = UserPeer::retrieveByPK( $iUserId );
    $classroom = ClassroomPeer::retrieveByPK( $iClassId );

    if( !$classroom instanceof Classroom || !$user instanceof User )
    {
      $this->error = 'Error';
      return sfView::ERROR;
    }

    $this->subscription = SubscriptionPeer::getFor( $iStype, $iUserId, $iClassId );

    if($this->subscription)
    {
      $this->subscription->delete();
      
      $this->error = 'You have successfully unsubscribed!';
      return sfView::ERROR;
    }

    $this->classroom = ClassroomPeer::retrieveByPK( $iClassId );
    $teacher = $this->classroom->getUser();

    $subscription = new Subscription();
    $subscription->setUserId( $iUserId );
    $subscription->setClassroomId( $iClassId );
    $subscription->setNotificationType( $iStype );
    $subscription->setTeacherId( $teacher->getId() );
    $subscription->save();

    $this->stype = $iStype;
  }

  public function executeIgnore()
  {
    $this->classmember=ClassroomMembersPeer::getFor( $this->getRequestParameter('userid'),
                                                     $this->getRequestParameter('catid'),
                                                     $this->getRequestParameter('classid') );
			
    if($this->classmember)
    {
      $this->classmember->delete();
			return sfView::SUCCESS;
		}
  }
  
}
