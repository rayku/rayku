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

	public function getForumId()
	{
		$c = new Criteria();
		$c->add(ForumPeer::ENTITY_ID, $this->getId());
		$c->add(ForumPeer::TYPE, Forum::TYPE_USER_FORUM);

		$forum = ForumPeer::doSelectOne($c);
		return $forum->getId();
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

  function createShoutFor( $recipient, $content )
  {
    ShoutPeer::createComment($recipient, $this, $content);
  }

  public function getAllRyaku()
	{

	$c=new Criteria();
	$c->add(UserPeer::ID,$this->getId());
	$awards = UserPeer::doSelectOne($c);
	return $awards->getPoints();
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
    $stats = array(
        'ryakuCount'      => $this->getAllRyaku(),
        'expertCount' => $this->getExpertScore()
    );

    return $stats;
  }

  function getLastQuestionsForDashboard()
  {
    return ThreadPeer::getLastUsersThreads(array($this->getId()), 8);
  }
  
  function isTutorStatusEnabled()
  {
      return ($this->getUserTutor() instanceof UserTutor);
  }
  
  function isTutorStatusDisabled()
  {
      return !$this->isTutorStatusEnabled();
  }
  
  function setTutorStatusDisabled()
  {
      $userTutor = $this->getUserTutor();
      if ($userTutor) {
          $userTutor->delete();
      }
  }
  
  function setTutorStatusEnabled()
  {
      $userTutor = $this->getUserTutor();
      if (!$userTutor) {
          $userTutor = new UserTutor;
          $userTutor->setUser($this);
          $userTutor->save();
      }
  }

    public function getFacebookCCUsername()
    {
        $userFb = $this->getUserFb();
        if ($userFb) {
            return '-'.$userFb->getFbUid().'@chat.facebook.com';
        }
    }

    public function getGtalkCCUsername()
    {
        $userGtalk = $this->getUserGtalk();
        if ($userGtalk) {
            return $userGtalk->getGtalkid();
        }
    }
    
    public function getDesktopCCUsername()
    {
        return $this->getEmail();
    }
    
    public function isWBSessionActive()
    {
        $criteria = new Criteria();
        $criteria->add(WhiteboardSessionPeer::USER_ID, $this->getId());
        $criteria->addDescendingOrderByColumn(WhiteboardSessionPeer::LAST_ACTIVITY);
        $lastSession = WhiteboardSessionPeer::doSelectOne($criteria);
        return ($lastSession && $lastSession->stillActive());
    }
    
    public function setRate($newRate)
    {
        $userRate = $this->getUserRateRecord();
        
        $userRate->setRate($newRate);
        $userRate->save();
    }
    
    private function getUserRateRecord()
    {
        $c = new Criteria;
        $c->setLimit(1);
        $userRate = $this->getUserRates($c);
        if (!is_array($userRate) || count($userRate) < 1) {
            $userRate = new UserRate;
            $userRate->setUser($this);
        } else {
            $userRate = $userRate[0];
        }
        return $userRate;
    }
    
    public function getRate()
    {
        $userRate = $this->getUserRateRecord();
        return $userRate->getRate();
    }
    
    public function getRateFormatted()
    {
        return number_format($this->getRate(), 2);
    }

}
