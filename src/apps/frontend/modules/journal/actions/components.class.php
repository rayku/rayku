<?php
/**
 * Journal components file
 *
 * @copyright Copyright (c) 2007, Critical Development
 * @author Adam A. Flynn <adamaflynn@criticaldevelopment.net>
 * @version 1.0
 */
class journalComponents extends sfComponents
{
	public function executeMostRecentEntry()
	{
		$user = $this->user;
		
		if (!$user instanceof User)
		{
			throw new sfException('User object was not passed');
		}
		
		/* @var $user User */
		
		$journalEntry = $user->getLatestJournalEntry();

		if (!$journalEntry instanceof JournalEntry)
		{
			return sfView::SUCCESS;
		}
		
		$currentUser = $this->getUser()->getRaykuUser();
		
		// if the user is logged in
		if ($currentUser instanceof User)
		{
			/* @var $currentUser User */
			// confirm that the user can view this gallery
			if (!$currentUser->canViewJournalEntry($journalEntry->getId()))
			{
				return sfView::SUCCESS;
			}
		}
		else
		{
			// if the user isn't logged in, check if it's public
			if ($journalEntry->getShowEntity() != JournalEntry::TYPE_PUBLIC )
			{
				return sfView::SUCCESS;
			}
		}
		
		// if we have made it to here, then we have a journal entry and it's viewable
		$this->journalEntry = $journalEntry;
	}
}
