<?php

/**
 * message actions.
 *
 * @package    elifes
 * @subpackage message
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class messageActions extends sfActions
{
	public function executeIndex()
	{
		$this->redirect('message/list');
	}
	
	/**
	* Displays either the inbox or outbox
	*/
	public function executeList()
	{	
		if($this->getRequestParameter('folder') == 'outbox')
		{
			//Grab all sent messages
      $c = PrivateMessagePeer::getCriteriaForSentToUser( $this->getUser()->getRaykuUserId() );

			//Name of the partial to use for each message
			$this->messageRowPartialName = 'message_row_outbox';
			
			//Name the URL for the pager
			$url = '@outbox';
		}
		else
		{
			//Grab all recieved messages
      $c = PrivateMessagePeer::getCriteriaForRecievedByUser( $this->getUser()->getRaykuUserId() );
      
			//Name of the partial to use for each message	
			$this->messageRowPartialName = 'message_row_inbox';
			
			//Name the URL for the pager
			$url = '@inbox';
		}
		
		//Setup the pager
		$pager = new sfPropelPager('PrivateMessage', sfConfig::get('app_messages_messages_per_page',10));
		$pager->setCriteria($c);
		$pager->setPage($this->getRequestParameter('page', 1));
		$pager->init();

    $this->friends = $this->getUser()->getRaykuUser()->getAllFriends();

    $this->raykuPager = new RaykuPagerRenderer( $pager );
    $this->raykuPager->setBaseUrl( $url );
	}
	
	/**
	* AJAX action to delete a PM
	*/
	public function executeDelete()
	{
		$pm = PrivateMessagePeer::getPrivateMessageByIdAndUser($this->getRequestParameter('id'), $this->getUser()->getRaykuUserId());
		
		//If such a PM doesn't exist, return an error
		if(!$pm)
			return sfVew::ERROR;
			
		//If this user was the sender, delete on the sender's end
		if($pm->getSenderId() == $this->getUser()->getRaykuUserId())
			$pm->deleteFromSender();
		
		//Otherwise, there's a pretty darn good chance that they were the
		//recipient, so, delete it on their end
		else
			$pm->deleteFromRecipient();
	}
	
	/**
	* Action to display the form to compose a message
	*/
	public function executeCompose()
	{
		// address book kind of thing
		$this->friends = $this->getUser()->getRaykuUser()->getAllFriends();
		
		$this->to = $this->getRequestParameter('nickname');
	}
	
	/**
	* AJAX action to send a message
	*/
	public function executeSend()
	{
		//Grab the user object
		$user = $this->getUser()->getRaykuUser();
		
		//Pull a User object for the recipient
		$c = new Criteria();
		$c->add(UserPeer::USERNAME, $this->getRequestParameter('name'));
		$recipient = UserPeer::doSelectOne($c);
		
		//Send the message
		$user->sendMessage($recipient->getId(), $this->getRequestParameter('subject'), $this->getRequestParameter('body'));
		
		$this->getUser()->addNotice('Your private message has been successfully sent');
		
		$this->redirect('message/index');
	}
	
	public function executeRead()
	{
		//Grab the PM object or false if there is an issue and store it as a
		//class member for the template to use
		$this->message = PrivateMessagePeer::getPrivateMessageByIdAndUser($this->getRequestParameter('id'), $this->getUser()->getRaykuUserId());

    //If there was an issue, throw an error
		if(!$this->message)
			return sfView::ERROR;

		if( $this->message && $this->message->getRecipientId() == $this->getUser()->getRaykuUserId() )
		{
      $this->message->setReadStatus( PrivateMessage::STATUS_READED );
      $this->message->save();
		}

    $this->friends = $this->getUser()->getRaykuUser()->getAllFriends();
	}
}
