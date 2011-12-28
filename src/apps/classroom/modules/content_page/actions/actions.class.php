<?php

/**
 * content_page actions.
 *
 * @package    elifes
 * @subpackage content_page
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class content_pageActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('content_page', 'list');
  }

  public function executeList()
  {
   		$c=new Criteria();
		$c->add(ContentPagePeer::CLASSROOM_ID, RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );
        $this->content_pages = ContentPagePeer::doSelect($c);
  }

  public function executeShow()
  {
    
	$this->id=$this->getRequestParameter('id');
	
	$this->content_page = ContentPagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->content_page);
	
	
	$page=new Criteria();
	$page->add(ContentPageAttachmentsPeer::CONTENT_PAGE_ID,$this->getRequestParameter('id'));
	$this->page_attach=ContentPageAttachmentsPeer::doSelect($page);


  }

  public function executeCreate()
  {
    $this->content_page = new ContentPage();
	$this->content_page->setClassroomId( RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->content_page = ContentPagePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->content_page);
	
	
	$c=new Criteria();
	$c->add(ContentPageAttachmentsPeer::CONTENT_PAGE_ID,$this->getRequestParameter('id'));
	$this->page_attach=ContentPageAttachmentsPeer::doSelect($c);

  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $content_page = new ContentPage();
    }
    else
    {
      $content_page = ContentPagePeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($content_page);
    }
	
	  	$fileName = $this->getRequest()->getFileName('file'); 
	    $uploadDir = sfConfig::get('sf_upload_dir') . DIRECTORY_SEPARATOR . 'content_page';
	   if($fileName != '')
	   {
			$target = $uploadDir . DIRECTORY_SEPARATOR . $fileName;
			$successfullyMoved = $this->getRequest()->moveFile('file', $target);
			if (!$successfullyMoved)
			{
				throw new Exception('Could not move uploaded file');
			}
	   }


    $content_page->setId($this->getRequestParameter('id'));
    $content_page->setTitle($this->getRequestParameter('title'));
    $content_page->setContent($this->getRequestParameter('content'));
    $content_page->setClassroomId( RaykuCommon::getCurrentClassroom( $this->getUser() )->getId() );

    $content_page->save();
	if($fileName!= '') {
		$page_attachments = new ContentPageAttachments();
		$page_attachments->setContentPageId($content_page->getId());
		$page_attachments->setFile($fileName);
		$page_attachments->save();
		
		}

	return $this->redirect('content_page/show?id='.$content_page->getId().'');
    //return $this->redirect('content_page/show?id='.$content_page->getId());
  }
  
  public function executeDeleteAttachment()
 {

 	$attach_page = ContentPageAttachmentsPeer::retrieveByPk($this->getRequestParameter('id'));
    $attach_page->delete();

    return $this->redirect('content_page/edit?id='.$this->getRequestParameter('pageid').'');

 }

  public function executeDelete()
  {
    $content_page = ContentPagePeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($content_page);

    $content_page->delete();

    return $this->redirect('content_page/list');
  }
}
