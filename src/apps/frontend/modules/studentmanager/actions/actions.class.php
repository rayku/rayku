<?php
/**
 * studentmanager actions.
 *
 * @package    elifes
 * @subpackage studentmanager
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class studentmanagerActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->classrooms = ClassroomPeer::getForStudentManager( $this->getUser()->getRaykuUser() );
    $this->lessons = ExpertLessonPeer::getForStudent( $this->getUser()->getRaykuUser() );
  }

  public function executeConfirmStudent()
  {
    $iUserId = $this->getRequestParameter('userid');
    $iCategoryId = $this->getRequestParameter('catid');
    $iClassId = $this->getRequestParameter('classid');
    $iConfirmationcode = $this->getRequestParameter('confirmationcode');

    $user = UserPeer::retrieveByPK( $iUserId );
		$category = CategoryPeer::retrieveByPK( $iCategoryId );
		$classroom = ClassroomPeer::retrieveByPK( $iClassId );
    
    if( !$user instanceof User || !$category instanceof Category || !$classroom instanceof Classroom )
    {
      $this->error = 'Error';
			return sfView::ERROR;
    }

		if( ClassroomMembersPeer::isUserApprovedMemberOfClassroom( $user, $classroom ) )
		{
      $this->error = 'The student is already confirmed for this class';
			return sfView::ERROR;
		}

    if( !$this->checkConfirmationStudentCode( $iConfirmationcode, $iClassId ) )
    {
      $this->error = 'Please enter valid confirmation code!';
      return sfView::ERROR;
    }

		$classmember = ClassroomMembersPeer::getFor( $iUserId, $iCategoryId, $iClassId );

		if( $classmember )
		{
			$classmember->setApproved(1);
			$classmember->save();
		}

    $teacher = $classroom->getUser();
    $this->sendConfirmStudentMail( $teacher, $classroom, $category, $user );
  }

  private function checkConfirmationStudentCode( $confirmationCode, $iClassRoomId )
  {   
    $confirmationCodeIsValid = false;

    if( $confirmationCode != '' )
    {
      $user = UserPeer::doSelectFromConfirmationStudentHash( $confirmationCode, $iClassRoomId );

      if( $user instanceof User )
        $confirmationCodeIsValid = true;
    }

    return $confirmationCodeIsValid;
  }

  private function sendConfirmStudentMail( $teacher, $classroom, $category, $student )
  {
    $this->mail = Mailman::createCleanMailer();

    $this->mail->addAddress( $student->getEmail() );
    $this->mail->setFrom('Teacher <'.$teacher->getEmail().'>');
    $this->mail->setSubject('joined to "'.$classroom->getFullName().'" classroom');
    sfProjectConfiguration::getActive()->loadHelpers( 'Partial' );
		$this->mail->setBody(
      get_partial(
        'confirmRequestEmail',
        array(
          'teacher'   => $teacher,
          'classroom' => $classroom,
          'category'  => $category,
          'student'   => $student
        ) ) );

    $this->mail->send();
  }

  public function executeSearch()
  {
    $classroom_search = trim( $this->getRequestParameter('classroom_search') );

  	if( $classroom_search != "" )
      $this->searchresult = ClassroomPeer::search( $classroom_search );
  }
   
  public function executeMoreactivity()
  {
		sfProjectConfiguration::getActive()->loadHelpers('Partial');
    return $this->renderText( get_partial( 'recent', array( 'historyEntries' => $this->getUser()->getRaykuUser()->getRecentHistory( 10 ) ) ) );
  }
  
  public function executeExpertprogram()
  {
		$this->account = $this->getRequestParameter('account');
 }
  
  public function executeExpertswitch()
  {
    $user = $this->getUser()->getRaykuUser();
		$user->setType( UserPeer::getTypeFromValue( 'expert' ) );
		$user->save();
		
	  $this->subscribeExpertToCategories( $this->getRequestParameter('categories'), $user);
    $this->getUser()->signIn( $user );
    $this->redirect( 'studentmanager/expertSwitchConfirmation' );
 }

  public function executeExpertSwitchConfirmation()
  {
  }
 
  private function subscribeExpertToCategories( $categories, $user )
  {
    if( !is_array( $categories ) )
      return;

    foreach($categories as $categoryid)
    {
      $expertcat = new ExpertCategory();
      $expertcat->setUserId($user->getId());
      $expertcat->setCategoryId($categoryid);
      $expertcat->save();
    }
  }
  
}