<?php

/**
 * forums actions.
 *
 * @package    elifes
 * @subpackage forums
 * @author     Your name here
 */
class forumsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {	

   	 $c= new Criteria();
	$c->add(ForumPeer::TYPE,0);
	$this->forum_list = ForumPeer::doSelect($c);


  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ForumForm(); 
	
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ForumForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new'); 
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($forum = ForumPeer::retrieveByPk($request->getParameter('id')), sprintf('Object forum does not exist (%s).', $request->getParameter('id')));
    $this->form = new ForumForm($forum); 
	
	
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($forum = ForumPeer::retrieveByPk($request->getParameter('id')), sprintf('Object forum does not exist (%s).', $request->getParameter('id')));
    $this->form = new ForumForm($forum);

    $this->processForm($request, $this->form);

  //  $this->setTemplate('edit'); 
  
   $this->redirect('forums/index');
	
	
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($forum = ForumPeer::retrieveByPk($request->getParameter('id')), sprintf('Object forum does not exist (%s).', $request->getParameter('id')));
    $forum->delete();

    $this->redirect('forums/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $forum = $form->save();

    //  $this->redirect('forums/edit?id='.$forum->getId()); 
	  
	  
     $this->redirect('forums/index');

	  
	  
    }
  }
}
