<?php

/**
 * Subclass for representing a row from the 'friend' table.
 *
 *
 *
 * @package lib.model
 */ 
class Friend extends BaseFriend implements HistoricalObjectI
{
  const TYPE_FRIEND_REQUEST_SENT = 0;
  const TYPE_FRIENDS = 1;
  const TYPE_FAMILY = 2;
  
	public function save(PropelPDO $con = null)
	{
    $new = $this->isNew();

	  $ret = parent::save($con);

		if( $new )
		{
			HistoryPeer::createFor($this);
		}

    return $ret;
	}

  public function delete(PropelPDO $con = null )
  {
    $ret = parent::delete( $con );
    HistoryPeer::createFor( $this );
    return $ret;
  }

  public function getDataForHistory()
  {
    $inviter = new HistoricalObjectEntry(
            $this->getUserId1(),
            array( 'left_user_id' => $this->getUserId1(),
                   'right_user_id' => $this->getUserId2(),
                   'deleted' => $this->isDeleted() )
            );

    $new_friend = new HistoricalObjectEntry(
            $this->getUserId2(),
            array( 'left_user_id' => $this->getUserId2(),
                   'right_user_id' => $this->getUserId1(),
                   'deleted' => $this->isDeleted() )
            );

    return array( $inviter, $new_friend );
  }

  public static function renderForHistory( HistoricalObjectEntry $historyEntryData )
  {
    $data = $historyEntryData->getData();

    $left = $historyEntryData->getUserLink($data['left_user_id']);
    $right = $historyEntryData->getUserLink($data['right_user_id']);

    return $left . ( isset( $data['deleted'] ) && $data['deleted'] ? ' is no longer a friend of ' : ' is now a friend of ' ). $right;
  }
}
