<?php

/**
 * cms actions.
 *
 * @package    elifes
 * @subpackage cms
 */
class cmsActions extends sfActions
{
	/**
	* Action to view a page
	*/
	public function executeView()
	{
		//Grab the page
		$this->page = GroupSitePagePeer::retrieveByPK($this->getRequestParameter('page_id'));
	}
	
	/**
	* Action to display the edit page
	*/
	public function executeEdit()
	{
		//Grab the user
		$user = $this->getUser()->getRaykuUser();
		
		//If the user isn't an admin, they can't edit pages
		if(!$user || $user->getGroupMembershipStatus($this->getRequestParameter('group_id')) != GroupUser::TYPE_ADMIN)
			return sfView::ERROR;
			
		//Grab the group object to pass to the template
		$this->group = GroupPeer::retrieveByPK($this->getRequestParameter('group_id'));
	}
	
	/**
	* Action to display the form to edit a page
	*/
	public function executeEditPageDisplay()
	{
		//Grab the user
		$user = $this->getUser()->getRaykuUser();
		
		//If the user isn't an admin, they can't edit pages
		if(!$user || !$user->canEditPage($this->getRequestParameter('page_id')))
			return sfView::ERROR;
		
		//Grab a page object	
		$this->page = GroupSitePagePeer::retrieveByPK($this->getRequestParameter('page_id'));
	}
	
	
	/**
	* Action to edit a page's title/contents in the DB... view contains an error
	* or success message
	*/
	public function executeEditPage()
	{
		$user = $this->getUser()->getRaykuUser();
		
		//If the user isn't an admin, they can't edit pages
		if(!$user || !$user->canEditPage($this->getRequestParameter('page_id')))
			return sfView::ERROR;
			
		//Grab the page
		$this->page = GroupSitePagePeer::retrieveByPK($this->getRequestParameter('page_id'));
		
		//Edit the content/title
		$this->page->setContent($this->getRequestParameter('content'));
		$this->page->setTitle($this->getRequestParameter('title'));
		
		//Save it
		$this->page->save();
	}
	
	/**
	* Action to create a new page... view contains JS code to add the page to
	* the menu.
	*/
	public function executeNewPage()
	{
		$user = $this->getUser()->getRaykuUser();
		
		//If the user isn't an admin, they can't edit pages
		if(!$user || $user->getGroupMembershipStatus($this->getRequestParameter('group_id')) != GroupUser::TYPE_ADMIN)
			return sfView::ERROR;
			
		$this->group = GroupPeer::retrieveByPK($this->getRequestParameter('group_id'));
			
		//Create the new page
		$page = new GroupSitePage();
		$page->setGroupId($this->getRequestParameter('group_id'));
		$page->setTitle('Untitled Page');
		
		//Set the page's order to 1000 to ensure it goes to the bottom of the
		//menu
		$page->setOrder(1000);
		$page->save();
	}
	
	/**
	* Action to delete a page. View contains JS code to fade the page out from
	* the menu
	*/
	public function executeDeletePage()
	{
		$user = $this->getUser()->getRaykuUser();
		
		//If the user isn't an admin, they can't edit pages
		if(!$user || !$user->canEditPage($this->getRequestParameter('page_id')))
			return sfView::ERROR;
			
		$this->id = $this->getRequestParameter('page_id');
			
		//Delete the page
		GroupSitePagePeer::doDelete($this->getRequestParameter('page_id'));
	}
	
	/**
	* Action to reorder the site's pages
	*/
	public function executeReorder()
	{
		$user = $this->getUser()->getRaykuUser();
		
		foreach($this->getRequestParameter('order') as $order => $pageID)
		{
			if($user->canEditPage($pageID))
			{
				$c = new Criteria();
				$c->add(GroupSitePagePeer::ID, $pageID);
				$c->add(GroupSitePagePeer::ORDER, $order);
				
				GroupSitePagePeer::doUpdate($c);
			}
		}
	}
}
