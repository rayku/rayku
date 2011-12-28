<?php

/**
 * Subclass for representing a row from the 'gallery_item' table.
 *
 * 
 *
 * @package lib.model
 */ 
class GalleryItem extends BaseGalleryItem implements HistoricalObjectI
{
	public function save(PropelPDO $con = null)
	{
    $new = $this->isNew();

    $this->setUserId( sfContext::getInstance()->getUser()->getRaykuUserId() );
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
	
	$link = link_to( 'gallery', '@gallery_index?user_id=' . $historyEntryData->getUserId() );

    return "$userLink has uploaded a file to $link";
  }
}
