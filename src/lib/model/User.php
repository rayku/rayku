<?php
 /**
 * Subclass for representing a row from the 'user' table.
 *
 *
 *
 * @package lib.model
 */
require_once 'om/BaseUser.php';

class User extends BaseUser
{
	/**
	* Generates the confirmation code for this user
	*/
	public function getConfirmationCode()
	{
    return UserPeer::generateConfirmationCode( $this );
	}
	/**
	* Generates the confirmation code for this Quickreg user
	*/
	public function getConfirmationValue()
	{
    		return UserPeer::generateConfirmationValue( $this );
	}
	
	/**
	* Hashes the password for entry into the DB
	*
	* @param string $v Unhashed password
	*/
	public function setPassword($v)
	{
		return parent::setPassword(sha1($v));
	}

	/**
	* Returns the user's name
	*/
	public function __toString()
	{
		return $this->getName();
	}

	/**
	* Returns the ucfirst'ed name of the user's current type index
	*/
	public function getTypeName()
	{
    if( $this->isTypeUnconfirmed() )
      return 'Unconfirmed';
    else
		  return ucfirst(UserPeer::getTypeFromIndex($this->getType()));
	}

	/**
	* Overwrites the delete method for User so that calling delete on a user
	* actually just bans/hides the user
	*/
	public function delete(PropelPDO $con = null)
	{
		parent::setHidden(true);
		return parent::save();
	}

	/**
	* Forcibly deletes a user from the DB, taking with it all foreign references
	* to it (pictures, albums, videos, threads, posts, etc, etc).
	*
	* It is very inadvisable to use this method because of the impact that it
	* can have on other users (if, for instance, this user started a thread,
	* that thread will be removed).
	*/
	public function forceDelete(PropelPDO $con = null)
	{
		return parent::delete($con);
	}

	/**
	* Adds a forum assigned to the user when it is created
	*
	* @return bool
	*/
	public function save(PropelPDO $con = null)
	{
		//Check if it's a new user before saving
		$new = $this->isNew();

		$this->setLastActivityAt(time());

		//Save and return false on an error
		if(!parent::save($con))
			return false;

		//If it was new...
		if($new)
		{
			//Create a forum for it
			$forum = new Forum();
			$forum->setName($this->getName());
			$forum->setType(Forum::TYPE_USER_FORUM);
			$forum->setEntityId($this->getId());

			//If the forum didn't work
			if(!$forum->save())
			{
				//Delete the group and return false
				$this->delete();

				return false;
			}
		}

		return true;
	}

	/**
	* Causes this user to send a request for friendship to $user
	*
	* @param int $userID User requesting friendship
	* @return bool
	*/
	public function requestFriendshipFrom( User $user, $dontSendPM = false )
	{
		//Uhh, you're not allowed to add yourself as a friend... that's just sad
		if( $user->getId() == $this->getId() )
			return false;

    if( !$user->isRequestedBy( $this ) )
    {
      $friend = new Friend();

      $friend->setUserRelatedByUserId1( $this );
      $friend->setUserRelatedByUserId2( $user );

      $saveStatus = $friend->save();




      if( !$dontSendPM )
      {
        sfProjectConfiguration::getActive()->loadHelpers(array('Url','Tag'));
      //  $kinkarsoUser = UserPeer::getByUsername(RaykuCommon::SITE_USER_USERNAME);


        if( $user )
        {
		  $link = link_to( 'Manage your Friend Requests', 'friends/members?username='.$user->getUsername() );
          $this->sendMessage(
            $user->getId(),
            $this->getUsername() . ' sent you a friend request',
            'Do you know this person? <a href="http://www.rayku.com/friends/acceptFriendshipRequest/'.$this->getID().'">Accept Friend Request</a> or you can '. $link,
            false
          );
        }
      }

      return $saveStatus;
    }
    else
      return false;
	}

	/**
	* Accepts/denies a friendship request from $friendID
	*
	* @param int $friendID UserID to accept/deny request from
	* @param bool $response
	*/
	public function respondToFriendshipRequestFrom($frienduser, $response)
	{
		//Grab the relevant friendship row
		$c = new Criteria();
		$c->add(FriendPeer::USER_ID1, $frienduser->getId());
		$c->add(FriendPeer::USER_ID2, $this->getId());
		$friend = FriendPeer::doSelectOne($c);

		//If there's no such friendship request, return false
		if(!$friend)
			return false;

		//If the user wants to be friends...
		if($response)
		{

			sfProjectConfiguration::getActive()->loadHelpers(array('Url','Tag'));
			//$kinkarsoUser = UserPeer::getByUsername(RaykuCommon::SITE_USER_USERNAME);

			if( $frienduser )
			{
			  $link = link_to( 'Your friends page', 'friends/members?username='.$frienduser->getUsername() );
			  $this->sendMessage(
				$frienduser->getId(),
				$this->getUsername() . ' has accepted your friend request!',
				'You may manage your friend requests and friend requests sent to you here: ' . $link,
				false
			  );
			}

			$friend->setStatus( 1 );
			return $friend->save();


		}

		//If the user would rather not be friends...
		$friend->delete();

		return true;
	}

	/**
	 * Removes a friendship between this user and the parameter user
	 *
	 * @param User $friendUser
	 */
	public function removeFriendshipWith(User $friendUser)
	{
		$c = new Criteria();
		$c->add(FriendPeer::USER_ID1, $this->getId());
		$c->add(FriendPeer::USER_ID2, $friendUser->getId());
		$friend = FriendPeer::doSelectOne($c);

		if ($friend instanceof Friend)
		{
			$friend->delete();
      return true;
		}
    else
      return false;
	}

	/**
	* Returns the Friendship type associated with this user's connection to
	* $friendID. Returns -1 if there is no connection.
	*
	* @param int $friendID
	* @return int
	*/
	public function getFriendshipStatus($friendID)
	{
		$c = new Criteria();

		//Look for cases where this user is ID1 and the friend is ID2
		$c1 = $c->getNewCriterion(FriendPeer::USER_ID1, $this->getId());
		$c1->addAnd($c->getNewCriterion(FriendPeer::USER_ID2, $friendID));
		$c->add($c1);

		//And cases where the friend is ID1 and this user is ID2
		$c2 = $c->getNewCriterion(FriendPeer::USER_ID1, $friendID);
		$c2->addAnd($c->getNewCriterion(FriendPeer::USER_ID2, $this->getId()));
		$c->addOr($c2);

		$friend = FriendPeer::doSelectOne($c);

		//If they aren't friends or there is no friend request, return -1
		if(!$friend)
			return -1;

		//Else return their friendship status
		return $friend->getStatus();
	}

	/**
	 * Gets all friends for this user.
	 *
	 * @return array
	 */
	public function getAllFriends()
	{
			return FriendPeer::getFriendsOf( $this );
	}





  /**
	 * Determines if a user is friends with another user
	 *
	 * @param User $friend
	 * @return boolean
	 */
	public function isFriendsWith(User $friend)
	{
    $iStatus = $this->getFriendshipStatus($friend->getId() );

    return ( ( -1 !== $iStatus ) && ( $iStatus != 0 ) );
	}

  /**
	 * Determines if a user is requested by another user
	 *
	 * @param User $friend
	 * @return boolean
	 */
  public function isRequestedBy(User $friend)
	{
    $c = new Criteria();

		//Look for cases where ID1 is requester and ID2 is this user and is requestee
		$c->add( FriendPeer::USER_ID1, $friend->getId() );
		$c->add( FriendPeer::USER_ID2, $this->getId() );
    $c->add( FriendPeer::STATUS, 0 );//don't send request to friend

    $requester = FriendPeer::doSelectOne($c);

    if( $requester instanceof Friend )
      return true;
    else
      return false;
	}

  public function canRequestForFriendship(User $friend)
  {
    if( !$this->isFriendsWith( $friend ) &&
        !$this->isRequestedBy( $friend ) &&
        !$friend->isRequestedBy( $this ) &&
        $this->getId() != $friend->getId() )
      return true;
    else
      return false;
  }

	/**
	* Returns the Group membership type associated with this user's connection
	* to $groupID. Returns -1 if there is no connection.
	*
	* @param int $groupID
	* @return int
	*/
	public function getGroupMembershipStatus($groupID)
	{
		//Grab this user's group membership status
		$c = new Criteria();
		$c->add(GroupUserPeer::USER_ID, $this->getId());
		$c->add(GroupUserPeer::GROUP_ID, $groupID);

		$groupUser = GroupUserPeer::doSelectOne($c);

		//If the user isn't a member (or hasn't applied), return -1
		if(!$groupUser)
			return -1;

		//Else return their membership status
		return $groupUser->getStatus();
	}

	/**
	* Determines if this user is able to edit the page with an ID of $pageID
	*
	* @param int $pageID
	* @return bool
	*/
	public function canEditPage($pageID)
	{
		//If the user's banned, they can't edit a page
		if($this->getHidden())
			return false;

		//Grab the page object
		$page = GroupSitePagePeer::retrieveByPK($pageID);

		//If the page doesn't exist or the user isn't an admin of the group that
		//contains the page... return false
		if(!$page || $this->getGroupMembershipStatus($page->getGroupId()) != GroupUser::TYPE_ADMIN)
			return false;

		//Otherwise, they're good
		return true;
	}

	/**
	* Sends a private message from this user to $recipientID
	*
	* @param int $recipientID
	* @param string $subject
	* @param string $message
	* @return bool
	*/
	public function sendMessage($recipientID, $subject, $message, $stripTags = true)
	{
		//If the user is banned, they can't send a message
		if($this->getHidden())
			return false;

    $recipient = UserPeer::retrieveByPK($recipientID);

    if( !$recipient )
      return false;

		$pm = new PrivateMessage();

		$pm->setSenderId($this->getId());
		$pm->setRecipientID($recipientID);
  //  $subject = $stripTags ? strip_tags($subject, sfConfig::get('app_general_allowed_html_tags')) : $subject;
		$pm->setSubject($subject);
 //   $message = $stripTags ? strip_tags($message, sfConfig::get('app_general_allowed_html_tags')) : $message;
		$pm->setBody($message);

		$saveStatus = $pm->save();


			$c = new Criteria();
			$c->add(NotificationEmailsPeer::USER_ID,$recipientID);
			$notifies = NotificationEmailsPeer::doSelectOne($c);

			if($notifies != NULL)
			{

				if($notifies->getOnOff() == 0)
				{

					if( $saveStatus )
					{
					  $mailer = Mailman::createMailer();
					  $mailer->setContentType('text/html');
					  $mailer->addAddress($recipient->getEmail());
					  $mailer->setSubject('New Private Message from Rayku.com');
					  sfProjectConfiguration::getActive()->loadHelpers(array('Url','Partial'));
					  $mailer->setBody(
						get_partial(
						  'global/mail/newPMNotification',
						  array('pm' => $pm)
						)
					  );

					  //Send the e-mail off
					  $mailer->send();
					}

				}
			}
			else
			{

					if( $saveStatus )
					{
					  $mailer = Mailman::createMailer();
					  $mailer->setContentType('text/html');
					  $mailer->addAddress($recipient->getEmail());
					  $mailer->setSubject('New Private Message from Rayku.com');
					  sfProjectConfiguration::getActive()->loadHelpers(array('Url','Partial'));
					  $mailer->setBody(
						get_partial(
						  'global/mail/newPMNotification',
						  array('pm' => $pm)
						)
					  );

					  //Send the e-mail off
					  $mailer->send();
					}

			}



    return $saveStatus;
	}

	/**
	* Checks to see if this user can view/post in the forum with an ID of
	* $forumID
	*
	* @param int $forumID
	* @return bool
	*/
	public function canAccessForum($forumID)
	{
		//If the user is banned, they can't view any forum
		if($this->getHidden())
			return false;

		//Grab the forum by its ID
		$forum = ForumPeer::retrieveByPK($forumID);

		//If the forum doesn't exist...
		if(!$forum)
			return false;

		//If the forum is a staff-only forum and this user isn't a mod or
		//admin...
		if($forum->getType() == Forum::TYPE_STAFF_ONLY_FORUM && $this->getType() < UserPeer::getTypeFromValue('moderator'))
			return false;

		//If the forum is a user forum and this user is less than friendly with
		//the person whose forum they're trying to post on...
		if($forum->getType() == Forum::TYPE_USER_FORUM && ($forum->getEntityId() !== $this->getId() && $this->getFriendshipStatus($forum->getEntityId()) < Friend::TYPE_FRIENDS))
			return false;

		//If the forum is a group forum and this user isn't a member of that
		//group...
		if($forum->getType() == Forum::TYPE_GROUP_FORUM && $this->getGroupMembershipStatus($forum->getEntityId()) < GroupUser::TYPE_MEMBER)
			return false;

		//If they haven't broken any of those rules, then they're allowed to
		//view and post in that forum
		return true;
	}

	/**
	* Makes a new thread by this user
	*
	* @param int $forumID
	* @param string $threadTitle
	* @param string $postBody
	* @return bool
	*/
	public function makeNewThread($forumID, $threadTitle, $postBody, $cat_id, $notify_email,$notify_pm,$tags,$school_grade)
	{
		//If the user is banned, they can't make a new thread
		if($this->getHidden())
			return false;

		//Create the thread
		$thread = new Thread();
		$thread->setTitle($threadTitle);
		$thread->setPosterId($this->getId());
		$thread->setForumId($forumID);

		$thread->setCategoryId($cat_id);
		$thread->setNotifyEmail($notify_email);
		$thread->setNotifyPm($notify_pm);
	//	$thread->setNotifySms($notify_sms);
	//	$thread->setCellNumber($cell_number);
		$thread->setTags($tags);
		$thread->setSchoolGrade($school_grade);

		//If the thread wasn't properly added to the DB, return false
		if(!$thread->save())
			return false;

		//Create the first post
		return $this->makeNewPost($thread->getId(), $postBody);
	}

	/**
	* Makes a new post by this user
	*
	* @param int $threadID
	* @param string $postBody
	* @return bool
	*/
	public function makeNewPost($threadID, $postBody)
	{
		//If the user is banned, they can't make a new post
		if($this->getHidden())
			return false;

		//Create the post
		$post = new Post();
		$post->setThreadId($threadID);
		$post->setContent($postBody, sfConfig::get('app_general_allowed_html_tags'));
		$post->setPosterId($this->getId());

		//If the post wasn't correctly added to the DB, return false
		return $post->save();
	}

	/**
	* Sends the number of points specified in $points to $userID
	*
	* @param int $userID
	* @param int $points
	* @return bool
	*/
	public function sendPointsToUser($userID, $points)
	{
		//If the user is banned, they can't give points
		if($this->getHidden())
			return false;

		//Nice try... you can't send negative points or send points to yourself
		//or send more points than you've got or send a non-numeric number of
		//points
		if($points < 1 || $userID == $this->getId() || $this->getPoints() < $points || !is_numeric($points))
			return false;

		$user = UserPeer::retrieveByPK($userID);

		//If there's no such user, return false
		if(!$user)
			return false;

		//Move the points
		$user->setPoints($user->getPoints() + $points);
		$this->setPoints($this->getPoints() - $points);

		//If the transaction worked on both ends, return true
		return ($user->save() && $this->save());
	}

	/**
	* Sends the number of points specified in $points to $groupID
	*
	* @param int $groupID
	* @param int $points
	* @return bool
	*/
	public function sendPointsToGroup($groupID, $points)
	{
		//If the user is banned, they can't give points
		if($this->getHidden())
			return false;

		//Nice try... you can't send negative points or send more points than
		//you've got or send a non-numeric number of points
		if($points < 1 || $this->getPoints() < $points || !is_numeric($points))
			return false;

		$group = GroupPeer::retrieveByPK($groupID);

		if(!$group)
			return false;

		//Move the points
		$group->setPoints($group->getPoints() + $points);
		$this->setPoints($this->getPoints() - $points);

		//If the group was bankrupt but now isn't, set the group as no longer
		//bankrupt
		if($group->getPoints() >= 0 && $group->getBankruptSince() != null)
			$group->setBankruptSince(null);

		//Return true if the transaction worked on both ends
		return ($group->save() && $this->save());
	}

	/**
	* Gives this user points from the administration. $points can be a positive
	* or negative value.
	*
	* @param int $points
	* @return bool
	*/
	public function sendPointsFromAdmin($points)
	{
	   	if($points == 0 || !is_numeric($points))
			return false;
		$this->setPoints($this->getPoints() + $points);

		return $this->save();
	}

	/**
	* Checks to see if this user can view a given journal entry
	*
	* @param int $entryID
	* @return bool
	*/
	public function canViewJournalEntry($entryID)
	{
		$journal = JournalEntryPeer::retrieveByPK($entryID);

		//If the journal entry doesn't even exist, return an error
		if(!$journal)
			return false;

		//If it's public, anyone can access
		if($journal->getShowEntity() == JournalEntry::TYPE_PUBLIC)
			return true;

		//If it belongs to themselves, they can see it
		if ($this->equals($journal->getUser()))
		{
			return true;
		}

		//If it's a friends & family or if it's a family only
		if($journal->getShowEntity() < JournalEntry::TYPE_FAMILY_ONLY)
		{
			//Get friendship status
			$friendshipStatus = $this->getFriendshipStatus($journal->getUserId());

			//If they aren't even friends, return false
			if($friendshipStatus < Friend::TYPE_FRIENDS)
				return false;

			//If they aren't family and this is family only, return false
			if($friendshipStatus < Friend::TYPE_FAMILY && $journal->getShowEntity() == JournalEntry::TYPE_FAMILY_ONLY )
				return false;

			return true;
		}

		//If it's an ACL-only thing...
		if($journal->getShowEntity() == JournalEntry::TYPE_SPECIFIC_PEOPLE_ONLY)
		{
			//See if the user's on the ACL
			$c = new Criteria();
			$c->add(JournalEntrYAclPeer::JOURNAL_ENTRY_ID, $journal->getId());
			$c->add(JournalEntryAclPeer::USER_ID, $this->getId());

			//If not, return false
			if(JournalEntryAclPeer::doCount($c) != 1)
				return false;

			//Otherwise, return true
			return true;
		}

		//If it doesn't fit any of the above criteria, something's badly wrong
		return false;
	}

	/**
	* Checks to see if a user can view the contents of a group
	*
	* @param int $groupID
	* @return bool
	*/
	public function canAccessGroup($groupID)
	{
		//If the user's banned...
		if($this->getHidden())
			return false;

		$group = GroupPeer::retrieveByPK($groupID);

		//If the group doesn't exist...
		if(!$group)
			return false;

		//If it's a public group...
		if($group->getType() == Group::TYPE_PUBLIC)
			return true;

		//If it's a private or hidden group and the user is a member...
		if($this->getGroupMembershipStatus($groupID) >= GroupUser::TYPE_MEMBER)
			return true;

		//Otherwise...
		return false;
	}

	/**
	* Determines if a user is a group admin
	*
	* @param int $groupID
	* @return bool
	*/
	public function isGroupAdmin($groupID)
	{
		return ($this->getGroupMembershipStatus($groupID) == GroupUser::TYPE_ADMIN);
	}

	/**
	* Makes this user request to join the group with an ID of $groupID. If the
	* group is public, there's no need for a join request.
	*
	* @param int $groupID
	* @return bool
	*/
	public function joinGroup($groupID)
	{
		$c = new Criteria();
		$c->add(GroupUserPeer::USER_ID, $this->getId());
		$c->add(GroupUserPeer::GROUP_ID, $groupID);

		//If the user's already in the group, don't let 'em join again
		if(GroupUserPeer::doCount($c) != 0)
			return false;

		//Grab the Group object
		$group = GroupPeer::retrieveByPK($groupID);

		//If it's a public group, become a member
		if( $group->getType() == Group::TYPE_PUBLIC )
			$status = GroupUser::TYPE_MEMBER;

		//Otherwise, just put in a join request
		else
			$status = GroupUser::TYPE_JOIN_REQUESTED;

		//Add the group_user entry
		$groupUser = new GroupUser();
		$groupUser->setGroupId($groupID);
		$groupUser->setUserId($this->getId());
		$groupUser->setStatus($status);

		return $groupUser->save();
	}

	public function getGroups($limit = 10, $includeRequested = false)
	{
		$c = new Criteria();

		$c->add(GroupUserPeer::STATUS, GroupUser::TYPE_MEMBER);
		$c->add(GroupUserPeer::USER_ID, $this->getId());

		if ($includeRequested)
		{
			$c->addOr(GroupUserPeer::STATUS, GroupUser::TYPE_JOIN_REQUESTED);
		}

		$c->setLimit($limit);

		$groupUsers = GroupUserPeer::doSelectJoinGroup($c);
		$groups = array();

		foreach ($groupUsers as $gu)
		{
			$groups[] = $gu->getGroup();
		}

		return $groups;
	}

	public function getForumId()
	{
		$c = new Criteria();
		$c->add(ForumPeer::ENTITY_ID, $this->getId());
		$c->add(ForumPeer::TYPE, Forum::TYPE_USER_FORUM);

		$forum = ForumPeer::doSelectOne($c);
		return $forum->getId();
	}

	/**
	 * Get the latest journal entry for this user
	 *
	 * @return JournalEntry
	 */
	public function getLatestJournalEntry()
	{
		$c = new Criteria();
		$c->addDescendingOrderByColumn(JournalEntryPeer::CREATED_AT);
		$c->add(JournalEntryPeer::USER_ID, $this->getId());

		return JournalEntryPeer::doSelectOne($c);
	}

	/**
	* Checks to see if this user can view a given gallery
	*
	* @param Gallery $gallery
	* @return bool
	*/
	public function canViewGallery($gallery)
	{
		// if it's public, anyone can access
		if ($gallery->getShowEntity() == Gallery::TYPE_PUBLIC)
			return true;

		// if it's the owner, they're allowed access
		if ($this->equals($gallery->getUser()))
			return true;

		// if it's a friends & family or if it's a family only
		if ($gallery->getShowEntity() < Gallery::TYPE_FAMILY_ONLY)
		{
			// get friendship status
			$friendshipStatus = $this->getFriendshipStatus($gallery->getUserId());

			// if they aren't even friends, return false
			if ($friendshipStatus < Friend::TYPE_FRIENDS)
				return false;

			// if they aren't family and this is family only, return false
			if ($friendshipStatus < Friend::TYPE_FAMILY &&
				$gallery->getShowEntity() == Gallery::TYPE_FAMILY_ONLY)
				return false;

			return true;
		}

		// if it's an ACL-only thing...
		if ($gallery->getShowEntity() == Gallery::TYPE_SPECIFIC_PEOPLE_ONLY)
		{
			// see if the user's on the ACL
			$c = new Criteria();
			$c->add(GalleryAclPeer::GALLERY_ID, $gallery->getId());
			$c->add(GalleryAclPeer::USER_ID, $this->getId());

			// if not, return false
			if (GalleryAclPeer::doCount($c) !== 1)
				return false;

			// otherwise, return true
			return true;
		}

		// if it doesn't fit any of the above criteria, something's badly wrong
		return false;
	}

	/**
	 * Removes nudges from a user
	 *
	 * @param User $user
	 * @return integer Count of affected rows
	 */
	public function removeNudgesFromUser(User $user)
	{
		$c = new Criteria();
		$c->add(NudgePeer::USER_FROM_ID, $user->getId());
		$c->add(NudgePeer::USER_TO_ID, $this->getId());

		return NudgePeer::doDelete($c);
	}

	/**
	 * Get nudges for a user
	 *
	 * @return array
	 */
	public function getNudges()
	{
		$c = new Criteria();
		$c->add(NudgePeer::USER_TO_ID, $this->getId());
		$c->addAscendingOrderByColumn(NudgePeer::CREATED_AT);

		return NudgePeer::doSelect($c);
	}

	/**
	 * Determines if you have content in your 'About Me'
	 *
	 * @return boolean
	 */
	public function hasAboutMe()
	{
		return !(
			null === $this->getAboutMe()
			|| '' === trim($this->getAboutMe())
		);
	}

	/**
	 * Returns the list of interests as a comma separated string
	 *
	 * @param string $separator
	 */
	public function getInterestsAsString($separator = ', ')
	{
		$interests = $this->getUserInterests();

		$interest_names = array();
		foreach ($interests as $interest)
		{
			/* @var $interest UserInterest */
			$interest_names[] = $interest->getInterest();
		}

		return implode($separator, $interest_names);
	}

	/**
	 * Creates user interests from string
	 *
	 * @param string $string Comma separated string of interests
	 * @return boolean
	 */
	public function setUserInterestsFromString($string)
	{
		$string = str_replace(', ', ',', $string);
		$interests = explode(',', $string);

		$this->deleteUserInterests();

		foreach ($interests as $interest)
		{
			$ui = new UserInterest();
			$ui->setUser($this);
			$ui->setInterest($interest);
			$ui->save();
		}

		return true;
	}

	/**
	 * Delete a user's interests
	 *
	 * @return integer Number of affected rows
	 */
	public function deleteUserInterests()
	{
		$c = new Criteria();
		$c->add(UserInterestPeer::USER_ID, $this->getId());

		return UserInterestPeer::doDelete($c);
	}

	/**
	 * Determines if the birth date is valid for display (not-null, greater than zero)
	 *
	 * @return boolean
	 */
	public function hasValidBirthDate()
	{
		$b = $this->getBirthdate('U');

		return (
			null !== $b &&
			$b > 0
		);
	}

	public function getRecentHistory($limit = 10)
	{
    $recentActivities = new RecentActivities();

    $recentActivities->setLimit( $limit );
    $rssContext = sfContext::getInstance()->getModuleName() == 'profile' ? 'profile' : null;

    return $recentActivities->fetchForUser($this, $rssContext);
	}

	public function getLiveFeed($limit = 1)
	{
		$recentActivities = new RecentActivities();
		// $recentActivities->setLimit( $limit );
		$rssContext = sfContext::getInstance()->getModuleName() == 'profile' ? 'profile' : null;
		return $recentActivities->fetchLiveFeed($this, $rssContext);
	}

	/**
	 * Generate new password reset key for this user
	 *
	 */
	public function generatePasswordRecoverKey()
	{
		do
		{
			$key = stringGenerator::generate();
			$key = sha1($key);

			// make sure that key isn't in use elsewhere..
			$c = new Criteria();
			$c->add(UserPeer::PASSWORD_RECOVER_KEY, $key);
			$count = UserPeer::doCount($c);

			$failure = ($count > 0);
		}
		while ($failure);

		$this->setPasswordRecoverKey($key);
		$this->save();
	}

	public function generateNewPassword()
	{
		$password = stringGenerator::generate(8);

		$this->setPassword($password);
		$this->save();

		return $password;
	}

	/**
	 * Get the age of a user
	 *
	 * @param boolean $decimal To return the years only, or the whole age
	 * @return number The user's age
	 */
	public function getAge($decimal = false)
	{
		$now = time();
		$then = $this->getBirthdate('U');

		$diff = $now - $then;

		$one_year = 31556926;

		$age = $diff / $one_year;

		if (!$decimal)
		{
			$age = floor($age);
		}

		return $age;
	}

	/**
	 * Find the online status of a user
	 *
	 * @return boolean
	 */
	public function isOnline()
	{
    if( $this->getInvisible() )
      return false;

		$then = $this->getLastActivityAt('U');
		$now = time();

		$diff = $now - $then;

		return $diff < sfConfig::get('app_profile_online_activity_timeout');
	}

	/**
	 * return number of awards user is having
	 */

	public function getCountUserAward()
	{
		$c = new Criteria();
		$c->add(UserAwardsPeer::USER_ID,$this->getId());
		$awards = UserAwardsPeer::doSelectOne($c);
		if($awards)
			return $awards->getAwards();
		else
			return 0;
	}

  /**
   * sets unconfirmed flag together with registration user type information
   * thanks to this when user confirms his accounts we know what type of user he should be
   * @TODO: maybe we should just add another field do user column
   */
  public function setTypeUnconfirmed( $type )
  {
    $this->setType( $type * -1 );
  }

  /**
   * @see User::setTypeUnconfirmed()
   */
  public function setTypeConfirmed()
  {
    $this->setType( $this->getType() * -1 );
  }

  public function isTypeUnconfirmed()
  {
    return $this->getType() < 0;
  }

  public function getComments()
  {
    return ShoutPeer::getUserComments( $this );
  }

  public function getNrOfNewMessages()
  {
    return PrivateMessagePeer::getNrOfNewMessagesFor($this);
  }

  function getTotalCreditsAmount()
  {
    return ExpertsCreditDetailsPeer::getTotalAmountFor($this);
  }

  function createShoutFor( $recipient, $content )
  {
    ShoutPeer::createComment($recipient, $this, $content);
  }

  public function getMediaCount()
	{

    	$c = new Criteria();
    	$c->add(GalleryItemPeer::USER_ID, $this->getId());
	$media = GalleryItemPeer::doSelect($c);
	return $media;

	}

  public function getAllRyaku()
	{

	$c=new Criteria();
	$c->add(UserPeer::ID,$this->getId());
	$awards = UserPeer::doSelectOne($c);
	return $awards->getPoints();
	}

	public function getAllJournals()
	{
		$connection = RaykuCommon::getDatabaseConnection();

			$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

	 $querynew = mysql_query("select * from journal_entry where user_id=".$logedUserId." ", $connection) or die(mysql_error());
	$countJournal = mysql_num_rows($querynew);

	 return $countJournal;

	}

	public function getExpertScore()
	{

		$connection = RaykuCommon::getDatabaseConnection();

			$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
			$query = mysql_query("select * from user_score where user_id=".$logedUserId." ", $connection) or die(mysql_error());
			$row = mysql_fetch_assoc($query);

		 return $row['score'];

	}


  function getStatisticsForDashboard()
  {


	$logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
	$cookiename = $logedUserId."_question";

    $stats = array(
        'teachersCount'   => count($this->getMediaCount()),
        'friendsCount'    => count($this->getAllFriends()),
        'ryakuCount'      => $this->getAllRyaku(),
        'journalCount' => $this->getAllJournals(),
        'expertCount' => $this->getExpertScore()
    );

    return $stats;
  }

  function getLastQuestionsForDashboard()
  {
    return ThreadPeer::getLastUsersThreads(array($this->getId()), 8);
  }

}
