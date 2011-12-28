<?php

/**
 * Subclass for representing a row from the 'journal_entry' table.
 *
 * 
 *
 * @package lib.model
 */ 
class JournalEntry extends BaseJournalEntry implements HistoricalObjectI
{
  const TYPE_PUBLIC = 0;
  const TYPE_PUBLIC_LABEL = 'Everyone';
  const TYPE_FRIENDS_AND_FAMILY = 1;
  const TYPE_FRIENDS_AND_FAMILY_LABEL = 'Friends Only';
  const TYPE_FAMILY_ONLY = 2;
  const TYPE_FAMILY_ONLY_LABEL = 'Family Only';
  const TYPE_SPECIFIC_PEOPLE_ONLY = 3;
  const TYPE_SPECIFIC_PEOPLE_ONLY_LABEL = 'Specific Friends (Select)';

	public function save(PropelPDO $con = null)
	{
    $new = $this->isNew();

    $ret = parent::save($con);

    if( $new )
      HistoryPeer::createFor($this);

    return $ret;
	}

  public function getDataForHistory()
  {
    return new HistoricalObjectEntry( $this->getUserId() );
  }

  public static function renderForHistory( HistoricalObjectEntry $historyEntryData )
  {
    $data = $historyEntryData->getData();

    $userLink = $historyEntryData->getUserLink();
		$link = link_to( 'journal', '@journal_index?user_id=' . $historyEntryData->getUserId() );

    return "$userLink made a post in $link";
  }

	public static function getTypes()
	{
		return array(
              JournalEntry::TYPE_PUBLIC => JournalEntry::TYPE_PUBLIC_LABEL,
              JournalEntry::TYPE_FRIENDS_AND_FAMILY => JournalEntry::TYPE_FRIENDS_AND_FAMILY_LABEL,
              JournalEntry::TYPE_SPECIFIC_PEOPLE_ONLY => JournalEntry::TYPE_SPECIFIC_PEOPLE_ONLY_LABEL,
              );
	}

  public function getNext()
  {
    return JournalEntryPeer::getNextOneAfterCreatedAt( $this->getUserId(), $this->getCreatedAt() );
  }

  public function getPrevious()
  {
    return JournalEntryPeer::getPreviouseOneBeforeCreatedAt( $this->getUserId(), $this->getCreatedAt() );
  }

}
