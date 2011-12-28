<?php

/**
 * Subclass for representing a row from the 'post' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Post extends BasePost implements HistoricalObjectI
{
	/**
	* Updates the lastpost_at field in this post's Thread and saves the post
	*/
	public function save(PropelPDO $con = null)
	{
		//Set the ID and lastpost_at to the right values
		$c = new Criteria();
		$c->add(ThreadPeer::ID, $this->getThreadId());
		$c->add(ThreadPeer::LASTPOST_AT, time());
		
		//Update the thread table
		ThreadPeer::doUpdate($c);

    $new = $this->isNew();
	  $ret = parent::save($con);

    if( $new )
      HistoryPeer::createFor($this);

    return $ret;
	}
	
	/**
	* Gets the User object referenced by the poster_id field.
	* 
	* @return User
	*/
	public function getPoster()
	{
		return UserPeer::retrieveByPK($this->getPosterId());
	}
	
	/**
	* Returns the contents of the post
	*/
	public function __toString()
	{
		return $this->getContent();
	}

	  public function getDataForHistory()
	  {
		
		$c = new Criteria();
		$c->add(ThreadPeer::ID,$this->getThreadId());
		$thread= ThreadPeer::doSelectOne($c);
		
		return new HistoricalObjectEntry( $this->getPosterId(), array( 'thread_id' => $this->getThreadId(), 'thread_title' => $thread->getTitle() ) );
	  }

  public static function renderForHistory( HistoricalObjectEntry $historyEntryData )
  {
    $data = $historyEntryData->getData();

    $userLink = $historyEntryData->getUserLink();

    return "$userLink posted in the thread \"" . link_to( $data['thread_title'], '@view_thread?thread_id=' . $data['thread_id'] ) . "\"" ;
  }
}
