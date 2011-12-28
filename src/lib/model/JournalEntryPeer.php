<?php

/**
 * Subclass for performing query and update operations on the 'journal_entry' table.
 *
 * 
 *
 * @package lib.model
 */ 
class JournalEntryPeer extends BaseJournalEntryPeer
{
  static function createHelloWorldEntryFor( User $user )
  {
    $journalEntry = new JournalEntry;
    $journalEntry->setUser( $user );
    $journalEntry->setShowEntity(JournalEntry::TYPE_FRIENDS_AND_FAMILY_LABEL);
    $journalEntry->setSubject( 'Hello World!' );
    $journalEntry->setContent( '<p>Welcome to Rayku! This is an example journal post that is displayed on your profile page. To get started, edit or delete this entry. You can even set who gets to see each journal entry. Give it a try!</p>' );
    $journalEntry->save();
  }

  static function getNextOneAfterCreatedAt($userId, $ceratedAt)
  {
    $c = new Criteria();
    $c->add(JournalEntryPeer::USER_ID, $userId);
    $c->add(JournalEntryPeer::CREATED_AT, $ceratedAt, Criteria::GREATER_THAN);
    $c->addAscendingOrderByColumn(JournalEntryPeer::CREATED_AT);
            
    return self::doSelectOne($c);
  }

  static function getPreviouseOneBeforeCreatedAt($userId, $ceratedAt)
  {
    $c = new Criteria();
    $c->add(JournalEntryPeer::USER_ID, $userId);
    $c->add(JournalEntryPeer::CREATED_AT, $ceratedAt, Criteria::LESS_THAN);
    $c->addDescendingOrderByColumn(JournalEntryPeer::CREATED_AT);

    return self::doSelectOne($c);
  }

   static function getJournalsOf(User $user)
   {
	   $c= new Criteria();
	   $c->add(JournalEntryPeer::USER_ID. $user);
	   return self::doSelectOne($c);
	   
   }


}
