<?php

/**
 * Subclass for performing query and update operations on the 'journal_entry_acl' table.
 *
 * 
 *
 * @package lib.model
 */ 
class JournalEntryAclPeer extends BaseJournalEntryAclPeer
{
  static function getSpecyficPeopleForJournalForSelect($journalId)
  {
    $c = new Criteria();
    $c->add(self::JOURNAL_ENTRY_ID, $journalId);
    $journalAcl = self::doSelect($c);

    $journal_friend = array();
    foreach($journalAcl as $journal)
    {
      $journal_friend[] = $journal->getUserId();
    }

    return $journal_friend;
  }
}
