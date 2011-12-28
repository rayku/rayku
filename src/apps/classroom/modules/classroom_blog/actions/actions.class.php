<?php
/**
 * classroom_blog actions.
 *
 * @package    elifes
 * @subpackage classroom_blog
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class classroom_blogActions extends sfActions
{
  public function executeIndex()
  {
  	return $this->forward('classroom_blog', 'list');
  }

  public function executeList()
  {
    $c = new Criteria();
  	$c->add(ClassroomBlogPeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
	  $c->addDescendingOrderByColumn('CREATED_AT');

    $this->classroom_blogs = ClassroomBlogPeer::doSelect($c);    
  }

  public function executeShow()
  {
    $this->classroom_blog = ClassroomBlogPeer::retrieveByPk($this->getRequestParameter('id'));

	  $c = new Criteria();
  	$c->add(ClassroomCommentPeer::CLASSROOM_BLOG_ID,$this->getRequestParameter('id'));

    $this->classroom_blog_comments = ClassroomCommentPeer::doSelect($c);
	  $this->forward404Unless($this->classroom_blog);

  	$blog=new Criteria();
	  $blog->add(BlogAttachmentsPeer::CLASSROOM_BLOG_ID,$this->getRequestParameter('id'));

	  $this->blog_attach=BlogAttachmentsPeer::doSelect($blog);
 }

  public function executeCreate()
  {
    $this->classroom_blog = new ClassroomBlog();
  	$this->classroom_blog->setClassroomId( RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->classroom_blog = ClassroomBlogPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->classroom_blog);

	  $c=new Criteria();
	  $c->add(BlogAttachmentsPeer::CLASSROOM_BLOG_ID,$this->getRequestParameter('id'));

    $this->blog_attach=BlogAttachmentsPeer::doSelect($c);

  }


  public function executeUpdate()
  {
    $fileName = $this->getRequest()->getFileName('file'); 

    $uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'blog';

    if($fileName != '')
    {
 			$target = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
  		$successfullyMoved = $this->getRequest()->moveFile('file', $target);

 			if (!$successfullyMoved)
     		throw new Exception('Could not move uploaded file');
    }
	   
    if (!$this->getRequestParameter('id'))
    {
     	$classroom_blog = new ClassroomBlog();
  		$classroom_blog->setTitle($this->getRequestParameter('title'));
  		$classroom_blog->setMessage($this->getRequestParameter('message'));
    	$classroom_blog->setClassroomId( RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
      $classroom_blog->save();

  	 	if($fileName!= '')
      {

    		$blog_attachments = new BlogAttachments();
        $blog_attachments->setClassroomBlogId($classroom_blog->getId());
        $blog_attachments->setFile($fileName);
        $blog_attachments->save();
  		}
    }
    else
    {
      $classroom_blog = ClassroomBlogPeer::retrieveByPk($this->getRequestParameter('id'));
      $classroom_blog->setId($this->getRequestParameter('id'));
      $classroom_blog->setTitle($this->getRequestParameter('title'));
      $classroom_blog->setMessage($this->getRequestParameter('message'));
      $classroom_blog->setClassroomId( RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
      $classroom_blog->save();

      if($fileName)
    	{
  	    $blog_attachments = new BlogAttachments();
    		$blog_attachments->setClassroomBlogId($classroom_blog->getId());
    		$blog_attachments->setFile($fileName);
        $blog_attachments->save();
      }
    }

  	$c=new Criteria();
  	$c->addJoin(UserPeer::ID,SubscriptionPeer::USER_ID,Criteria::JOIN);
    $c->add(SubscriptionPeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
    $c->add(SubscriptionPeer::NOTIFICATION_TYPE,1);

  	$user=UserPeer::doSelect($c);

  	foreach($user as $user1)
    {
      $this->mail = Mailman::createCleanMailer();
      $this->mail->addAddress($user1->getEmail());
      $this->mail->setFrom('Teacher <'.$this->getUser()->getRaykuUser()->getEmail().'>');
      $this->mail->setSubject($this->getRequestParameter('title').'blog');
      sfProjectConfiguration::getActive()->loadHelpers(array('Partial'));
      $this->mail->setBody( include_partial( 'updateEmail' ) );
      $this->mail->send();
	  }

    return $this->redirect('classroom_blog/show?id='.$classroom_blog->getId());
  }

  public function executeDelete()
  {
    $classroom_blog = ClassroomBlogPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($classroom_blog);
    $classroom_blog->delete();
    return $this->redirect('classroom_blog/list');
  }

  public function executeDeleteAttachment()
  {
  	$attach_blog = BlogAttachmentsPeer::retrieveByPk($this->getRequestParameter('id'));
    $attach_blog->delete();
    return $this->redirect('classroom_blog/edit?id='.$this->getRequestParameter('blogid').'');
  }

  public function executeComment()
  {
  	$blogid = $this->getRequestParameter('classroom_blog_id');
  	$this->classroom_comment = new ClassroomComment();
  	$this->classroom_comment->setClassroomBlogId($blogid);
    $this->classroom_comment->setUserId($this->getUser()->getRaykuUserId());
  	$this->classroom_comment->setContent($this->getRequestParameter('content'));
    $this->classroom_comment->setApproved(0);
    $this->classroom_comment->setPostedAt(date('Y-m-d G:i:s',time()));
	  $this->classroom_comment->save();
    return $this->redirect('classroom_blog/show?id='.$this->getRequestParameter('classroom_blog_id'));
  }
}