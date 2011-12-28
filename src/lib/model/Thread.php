<?php

/**
 * Subclass for representing a row from the 'thread' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Thread extends BaseThread implements HistoricalObjectI
{
	/**
	* The most recent Post in the Thread
	* 
	* @var Post
	*/
	private $lastPost;
	
	/**
	* Returns the Thread's name
	* 
	* @return string
	*/
	public function __toString()
	{
		return $this->getTitle();
	}
	
	/**
	* Gets the most recent post in the thread and stores it in $this->lastPost.
	* If it has already been stored, it doesn't fetch it again.
	* 
	* @return Post
	*/
	public function getLastPost()
	{
		//If no lastPost is stored
		if(!$this->lastPost)
		{
			//Grab it
			$c = new Criteria();
			$c->add(PostPeer::THREAD_ID, $this->getId());
			$c->addDescendingOrderByColumn(PostPeer::UPDATED_AT);
			
			$this->lastPost = PostPeer::doSelectOne($c);
		}
		
		//Return it
		return $this->lastPost;
	}

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
    return new HistoricalObjectEntry( $this->getPosterId(), array( 'thread_id' => $this->getId(), 'thread_title' => $this->getTitle() ) );
  }

  public static function renderForHistory( HistoricalObjectEntry $historyEntryData )
  {
    $data = $historyEntryData->getData();

    $userLink = $historyEntryData->getUserLink();

    return "$userLink published a new thread, entitled \"" . link_to( $data['thread_title'], '@view_thread?thread_id=' . $data['thread_id'] ) . "\"";
  }

  public function getRepliesCount()
  {
    return PostPeer::getCountForThread($this);
  }
}
