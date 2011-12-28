<?php

/**
 * Subclass for representing a row from the 'private_message' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PrivateMessage extends BasePrivateMessage
{
	const STATUS_NO_DELETION = 0;
  const STATUS_SENDER_DELETION = 1;
  const STATUS_RECIPIENT_DELETION = 2;

  const STATUS_UNREADED = 0;
  const STATUS_READED = 1;

	protected static $statusValues;

	/**
	* Deletes the PM on the sender's end. If the recipient has already deleted
	* the message, then just remove it from the DB. Otherwise, mark it deleted
	* by recipient.
	* 
	* @return bool
	*/
	public function deleteFromSender()
	{
		//If the recipient deleted it already and now the recipient wants to 
		//delete it, just delete it from the DB as no one wants it anymore
		if($this->getStatus() == PrivateMessage::STATUS_RECIPIENT_DELETION)
			return $this->delete();
			
		//Otherwise, note that the recipient sender the message
		$this->setStatus(PrivateMessage::STATUS_SENDER_DELETION);
		
		return $this->save();
	}
	
	/**
	* Deletes the PM on the recipient's end. If the sender has already deleted
	* the message, then just remove it from the DB. Otherwise, mark it deleted
	* by sender.
	* 
	* @return bool
	*/
	public function deleteFromRecipient()
	{
		//If the sender deleted it already and now the recipient wants to delete
		//it, just delete it from the DB as no one wants it anymore
		if($this->getStatus() == PrivateMessage::STATUS_SENDER_DELETION)
			return $this->delete();
			
		//Otherwise, note that the recipient deleted the message
		$this->setStatus(PrivateMessage::STATUS_RECIPIENT_DELETION);
		
		return $this->save();
	}
	
	/**
	* Returns the created_at field as the string of a date according to the date
	* format laid out in app_general_date_format
	*/
	public function getFormattedDate()
	{
		return date(sfConfig::get('app_general_date_format'), strtotime($this->getCreatedAt()));
	}
	
        // TODO: Im not sure if this relation should be reflected in database schema
	public function getSender()
	{
          return UserPeer::retrieveByPK( $this->getSenderId() );
	}
	
        // TODO: Im not sure if this relation should be reflected in database schema
	public function getRecipient()
	{
          return UserPeer::retrieveByPK( $this->getRecipientId() );
	}
}
