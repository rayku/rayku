<?php
/**
  * classmanager actions.
  *
  * @package    elifes
  * @subpackage classmanager
  * @author     Dreamajax Technologies
  * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */

class classmanagerActions extends sfActions
{

   public function executeIndex()
   {
	   setcookie("banner");
	    return $this->forward('classmanager', 'list');
   }

   public function executeList()
   {
		$cri= new Criteria();
		$cri->addJoin(ClassroomMembersPeer::CLASSROOM_ID,ClassroomPeer::ID,Criteria::JOIN);
		$cri->addJoin(ClassroomPeer::USER_ID,UserPeer::ID,Criteria::JOIN);
		$cri->add(UserPeer::ID,$this->getUser()->getRaykuUser()->getId());
		$cri->add(ClassroomMembersPeer::APPROVED,'0');

		$c = new Criteria();
		$c->add(ClassroomPeer::USER_ID,$this->getUser()->getRaykuUserId());
		$this->classrooms = ClassroomPeer::doSelect($c);
  }


   public function executeShow()
   {

      $cri= new Criteria();
	  $cri->add(ClassroomPeer::ID,$this->getRequestParameter('id'));
	  $this->classroom=ClassroomPeer::doSelectOne($cri);

	  $c= new Criteria();
	  $c->add(CategoryPeer::ID,$this->classroom->getCategoryId());
	  $this->category =CategoryPeer::doSelectOne($c);

    $this->forward404Unless($this->classroom);

   }

  public function executeTest()
  {
		$cuser=$this->getRequestParameter('cuser');
		
		$c=new Criteria();
		$c->add(ClassroomPeer::CLASS_USERNAME,$this->getRequestParameter('cuser'));
		$this->classusername=ClassroomPeer::doSelectOne($c);
		
		if($this->classusername) 
		{
			$msg = 'Username Already Exists';
		}else
		{
			$msg = 'Username Accepted';
		}

    $this->msg = $msg;
  }
  
  public function executeCreate()
  {
	  $c=new Criteria();
	  $c->add(ClassroomPeer::USER_ID,$this->getUser()->getRaykuUserId());
	  $count=ClassroomPeer::doCount($c);
	  
	  $this->setTemplate('edit');
	  
	  
	  if($count < 10)
	  {
	  		$this->classroom = new Classroom();
	  }
	  else
	  {
	  		return sfView::ERROR;
	  
	  }
	  
   }

   public function executeEdit()
   {
	  $this->classroom = ClassroomPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($this->classroom);
   }

   public function executeUpdate()
   {
	  if (!$this->getRequestParameter('id'))
    {
      $classroom = new Classroom();
      $classroom->setUserId($this->getUser()->getRaykuUserId());
    }
    else
    {
      $classroom = ClassroomPeer::retrieveByPk($this->getRequestParameter('id'));
      $classroom->setUserId($this->getRequestParameter('user_id'));
      $this->forward404Unless($classroom);
    }
		
	  if($this->getRequestParameter('shortname'))
    {
      $classroom->setShortname($this->getRequestParameter('shortname'));
    }
	  else
	  {
      $category = CategoryPeer::retrieveByPk($this->getRequestParameter('category_id'));
      $prefix = $category->getPrefix();

		  $shortname_serial_count = rand(0,100);
		  $shortname = "$prefix"."$shortname_serial_count"; 
		  $classroom->setShortname($shortname);
 	  }

	  if($this->getRequestParameter('idnumber'))
    {
      $classroom->setIdnumber($this->getRequestParameter('idnumber'));
    }
	  else
	  {
      $classroom->setIdnumber("$shortname_serial_count".$this->getRequestParameter('id'));
    }

    $classroom->setCategoryId($this->getRequestParameter('category_id'));

    if($_COOKIE['banner'] != '')
    {
      $classroom->setClassroomBanner($_COOKIE['banner']);
    }

     $classemail=  $this->getRequestParameter('email_passcode').'.'.$this->getRequestParameter('class_username').'@rayku.com';
   
    $classroom->setClassUsername($this->getRequestParameter('class_username'));
    $classroom->setEmailPasscode($this->getRequestParameter('email_passcode')); 
    $classroom->setFullname($this->getRequestParameter('fullname'));
    $classroom->setSchoolName($this->getRequestParameter('school_name')); 
    $classroom->setLocation($this->getRequestParameter('location'));
    $classroom->setSummary($this->getRequestParameter('summary'));
    $classroom->setLiveWebcam($this->getRequestParameter('webcam', 0));
    $classroom->setEmailUpdateBlog($this->getRequestParameter('blog_update', 0));
	$classroom->setClassroomEmail($classemail); 

    $classroom->save();
	  
    $cpuser = 'rayku'; // cPanel username
    $cppass = 'indiaca45445'; // cPanel password
    $cpdomain = 'rayku.com'; // cPanel domain or IP
    $cpskin = 'x3';  // cPanel skin. Mostly x or x2.
						
						
    $euser = $this->getRequestParameter('email_passcode').'.'.$this->getRequestParameter('class_username');
    $epass = $this->getRequestParameter('email_passcode');
    $edomain = 'rayku.com'; // email domain (usually same as cPanel domain above)
    $equota = 5; // amount of space in megabytes
						
    $msg = '';
						
    if (!empty($euser))
    while(true)
    {
      // Create email account
      $f = fopen ("http://$cpuser:$cppass@$cpdomain:2082/frontend/$cpskin/mail/doaddpop.html?email=$euser&domain=$edomain&password=$epass&quota=$equota", "r");
						 
      while (!feof ($f))
      {
        $line = fgets ($f, 1024);
        if (ereg ("already exists", $line, $out))
        {
          break;
        }
      }

      @fclose($f);
      break;
						 
      if (!$f)
      {
        break;
      }
    }
	
    if($classroom->getId())
    {
      $gallery = new Gallery();
      $gallery->setTitle('Class Gallery');
      $gallery->setShowEntity(0);
      $gallery->setClassroomId($classroom->getId());
      $gallery->save();
    }
	
	
    if($classroom->getId())
    {
      $classroom_forum=new ClassroomForum();
      $classroom_forum->setForumName($classroom->getFullname());
      $classroom_forum->setDescription($classroom->getSummary());
      $classroom_forum->setClassroomId($classroom->getId());
      $classroom_forum->save();
    }
	
    if($classroom->getId())
    {
      $c=new Criteria();
      $c->add(ClassroomBlogPeer::TITLE,$classroom->getFullname());
      $c->add(ClassroomBlogPeer::CLASSROOM_ID,$classroom->getId());
      $this->check=ClassroomBlogPeer::doSelect($c);

      if($this->check == NULL)
      {
        $classroom_blog=new ClassroomBlog();
        $classroom_blog->setTitle($classroom->getFullname());
        $classroom_blog->setMessage($classroom->getSummary());
        $classroom_blog->setClassroomId($classroom->getId());
        $classroom_blog->save();
      }

    }

    return $this->redirect('classroom/index?id='.$classroom->getId());

  }

  public function executeDelete()
  {
    $classroom = ClassroomPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($classroom);
    $classroom->delete();
    return $this->redirect('classmanager/list');
  }

  public function executeWriteMail()
  {
    $c=new Criteria();
    $c->add(ClassroomPeer::USER_ID,$this->getUser()->getRaykuUserId());
    $this->allclassroom=ClassroomPeer::doSelect($c);
    $cls=new Criteria();
    $cls->addJoin(UserPeer::ID,ClassroomMembersPeer::USER_ID,Criteria::JOIN);
    $cls->add(ClassroomMembersPeer::CLASSROOM_ID,$this->getRequestParameter('classroom'));
    $this->allstudents=UserPeer::doSelect($cls);

    if($this->getRequestParameter('user')!='')
    {
      $userarray=$this->getRequestParameter('user');
      foreach($userarray as $userid)
      {
        $u=new Criteria();

        $u->add(UserPeer::ID,$userid);
        $this->user=UserPeer::doSelectone($u);
        $this->mail = Mailman::createMailer();

        //Set the to, from, and subject headers
        $this->mail->addAddress($this->user->getEmail());
        $this->mail->setFrom('Teacher <'.$this->getUser()->getRaykuUser()->getEmail().'>');
        $this->mail->setSubject($this->getRequestParameter('subject'));
        $this->mail->setBody(str_replace('&nbsp;', '', strip_tags( $this->getRequestParameter('bodycontent'))));

        //Send the e-mail off
        $this->mail->send();

        return $this->redirect('classmanager/sendMail');
      }
    }
  }

  public function executeMoreactivity()
  {
    sfProjectConfiguration::getActive()->loadHelpers('Partial');
    $historyEntries = $this->getUser()->getRaykuUser()->getRecentHistory( 10 );
    return $this->renderText( get_partial( 'recent', array( 'historyEntries' => $historyEntries ) ) );
  }

  public function executeSendMail()
  {

  }

}
