<?php

/**
 * journal actions.
 *
 * @package    elifes
 * @subpackage journal
 * @author     Nathan Wong <nathan.wong@gmail.com>
 */
class journalActions extends sfActions
{
	public function executeEditForm()
	{
		$this->expertname= $this->getUser()->getRaykuUser()->getName();
		$this->expertusr= $this->getUser()->getRaykuUser()->getid();



    $journalId = $this->getRequestParameter('id');
		$this->friends = $this->getUser()->getRaykuUser()->getAllFriends();
		$this->selectedFriends = JournalEntryAclPeer::getSpecyficPeopleForJournalForSelect($journalId);

		if($journalId)
		{
			$this->journal = JournalEntryPeer::retrieveByPK($journalId);
			
			if(!$this->journal || $this->journal->getUserId() != $this->getUser()->getRaykuUserId())
				return sfView::ERROR;
		}
		else
			$this->journal = new JournalEntry();
	}
	
	public function executeEdit()
	{
	



		$journal = JournalEntryPeer::retrieveByPK($this->getRequestParameter('id'));

		if (!$journal instanceof JournalEntry)
			$journal = new JournalEntry;
    else
		{
			//If they're editing a non-existent journal or editing an entry that
			//isn't theirs, go to an error
			if(!$journal || $journal->getUserId() != $this->getUser()->getRaykuUserId())
				return sfView::ERROR;
				
			//Clear the journal's ACL
			$c = new Criteria();
			$c->add(JournalEntryAclPeer::JOURNAL_ENTRY_ID, $this->getRequestParameter('id'));
			JournalEntryAclPeer::doDelete($c);
		}
			
		//Set the details
		$journal->setSubject($this->getRequestParameter('subject'));
		$journal->setContent($this->getRequestParameter('content'));
		$journal->setUserId($this->getUser()->getRaykuUserId());
		$journal->setShowEntity($this->getRequestParameter('journalentry[type]'));
		$journal->save();
		
		//If the journal is ACL restricted...
		if($this->getRequestParameter('journalentry[type]') == JournalEntry::TYPE_SPECIFIC_PEOPLE_ONLY)
		{
			//For each journal entry ACL member...
			foreach($this->getRequestParameter('friend') as $user => $one)
			{
				//Setup an ACL entry
				$jea = new JournalEntryAcl();
				$jea->setJournalEntryId($journal->getId());
				$jea->setUserId($user);
				$jea->save();
			}
		}
			
		$this->redirect('journal/view?id='.$journal->getId());
	}
	
	public function executeView()
	{




		$this->journal = JournalEntryPeer::retrieveByPK($this->getRequestParameter('id'));
		
		//If the journal is not valid, return an error
		if (!$this->journal)
			return sfView::ERROR;
		
		$user = $this->getUser()->getRaykuUser();
    if(!$user instanceof User)
      return sfView::ERROR;
    
		$this->owner = $this->journal->getUser();
		//Confirm that the user can view this entry
		if(!$user->canViewJournalEntry($this->journal->getId()))
			return sfView::ERROR;
	}
	
	public function executeIndex()
	{




		$user = UserPeer::retrieveByPK($this->getRequestParameter('user_id'));
		
		$this->forward404Unless($user instanceof User);
		
		// pull out journal entries for user
		/** @todo: filter based on ACL */
		$c = new Criteria();
		$c->add(JournalEntryPeer::USER_ID, $user->getId());
		$c->addDescendingOrderByColumn(JournalEntryPeer::CREATED_AT);
		
		$journalEntries = JournalEntryPeer::doSelect($c);
		if( count($journalEntries) > 0 )
      $this->redirect('journal/view?id='.$journalEntries[0]->getId());
    
		// assign vars to view
		$this->journalEntries = $journalEntries;
		$this->owner = $user;
	}
	
	public function handleErrorEdit()
	{
		return sfView::SUCCESS;
	}

  public function executeDelete()
  {



    $journal = JournalEntryPeer::retrieveByPk($this->getRequestParameter('id'));

    if(!$journal || $journal->getUserId() != $this->getUser()->getRaykuUserId())
    {
      $this->setTemplate('view');
      return sfView::ERROR;
    } else {
      $journal->delete();
    }

    $this->redirect('journal/index?user_id='.$this->getUser()->getRaykuUserId());
  }
}
