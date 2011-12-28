<?php

/**
 * Subclass for performing query and update operations on the 'private_message' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PrivateMessagePeer extends BasePrivateMessagePeer
{
	/**
	* Takes a PM ID and User ID as parameters and returns the PrivateMessage
	* object of the corresponding PM. If it does not return a valid object,
	* one of two things happened:
	*  - The PM doesn't exist
	*  - The PM was neither sent nor received by $userID
	* 
	* In either case, the Controller calling this method can react (probably
	* by throwing an error).
	* 
	* @param int $messageID
	* @param int $userID
	* @return PrivateMessage|false
	*/
	static public function getPrivateMessageByIdAndUser($messageID, $userID)
	{
		$c = new Criteria();
		
		//Select the PM with the given ID
		$c->add(self::ID, $messageID);
		
		//But make sure that the $userID is either the sender or the recipient
		$s = $c->getNewCriterion(self::SENDER_ID, $userID);
		$s->addOr($c->getNewCriterion(self::RECIPIENT_ID, $userID));
		$c->add($s);
		
		//Return that PM object
		return self::doSelectOne($c);
	}

  static public function getCriteriaForSentToUser( $userId )
  {
    $c = new Criteria();
    $c->add(PrivateMessagePeer::SENDER_ID, $userId);
    $c->add(PrivateMessagePeer::STATUS, PrivateMessage::STATUS_SENDER_DELETION, Criteria::NOT_EQUAL);
    $c->addDescendingOrderByColumn(PrivateMessagePeer::CREATED_AT);

    return $c;
  }

  static public function getCriteriaForRecievedByUser( $userId )
  {
    $c = new Criteria();
    $c->add(PrivateMessagePeer::RECIPIENT_ID, $userId);
    $c->add(PrivateMessagePeer::STATUS, PrivateMessage::STATUS_RECIPIENT_DELETION, Criteria::NOT_EQUAL);
    $c->addDescendingOrderByColumn(PrivateMessagePeer::CREATED_AT);

    return $c;
  }
  static function getNrOfNewMessagesFor(User $user)
  {
    $c = new Criteria;
    $c->add( self::RECIPIENT_ID, $user->getId() );
    $c->add( self::READ_STATUS, PrivateMessage::STATUS_UNREADED );
    return self::doCount($c);
  }
}
