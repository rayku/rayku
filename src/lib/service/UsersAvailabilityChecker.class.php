<?php

/**
 * The job of this class is to check current online/offline status of all users
 *
 * @author lukas
 */
class UsersAvailabilityChecker
{
    /**
     * prefetched gtalk ids indexed by user id
     */
    private $gtalkIds = array();

    /**
     * prefetched FB ids indexed by user id
     */
    private $fbIds = array();

    /**
     * Simple array with all fb usernames currently being online
     */
    private $fbOnlineUsers = array();

    /**
     * Simple array with all gtalk usernames currently being online
     */
    private $gtalkOnlineUsers = array();

    private function fetchOnlineStatusFromIMBots()
    {
        $fbUsersJSON = BotServiceProvider::createFor(sfConfig::get('app_facebook_url')."/tutor")->getContent();
        $fbUsers = json_decode($fbUsersJSON, true);

        foreach ($fbUsers as $fbUser) {
            if (trim($fbUser['username']) != '') {
                $this->fbOnlineUsers[] = trim($fbUser['username']);
            }
        }

        $onlineTutorsByNotificationBot = BotServiceProvider::createFor(sfConfig::get('app_notification_bot_url')."/tutor")->getContent();
        $this->botOnlineUsers = json_decode($onlineTutorsByNotificationBot, true);

        $gtalkUsersJSON = BotServiceProvider::createFor(sfConfig::get('app_rayku_url').":".sfConfig::get('app_g_chat_port')."/onlines")->getContent();
        $gtalkUsers = json_decode($gtalkUsersJSON, true);

        foreach ($gtalkUsers as $gtalkUserId => $status) {
            $parts = explode('/', $gtalkUserId);
            if (trim($parts[0]) != '') {
                $this->gtalkOnlineUsers[] = trim($parts[0]);
            }
        }
    }

    /**
     * prefetches all gtalk and fb IDS
     */
    private function fetchCCIds()
    {
        $c = new Criteria();
        $result = UserGtalkPeer::doSelectStmt($c);
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->gtalkIds[$row['USERID']] = $row['GTALKID'];
        }

        $c = new Criteria();
        $result = UserFbPeer::doSelectStmt($c);
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $this->fbIds[$row['USERID']] = $row['FB_USERNAME'];
        }
    }

    function isGtalkOnline(User $user)
    {
        if (!isset($this->gtalkIds[$user->getId()])) {
            return false;
        }

        return in_array($this->gtalkIds[$user->getId()], $this->gtalkOnlineUsers);
    }

    private function isFBOnline(User $user)
    {
        if (!isset($this->fbIds[$user->getId()])) {
            return false;
        }

        return in_array($this->fbIds[$user->getId()], $this->fbOnlineUsers);
    }

    private function isMACOnline(User $user)
    {
        if (is_array($this->botOnlineUsers)) {
            foreach ($this->botOnlineUsers as $botUser) {
                if ($botUser['email'] == $user->getEmail()) {
                    return true;
                }
            }
        }
    }

    function getOnlineUsers()
    {
        $this->counts = array(
            'web' => 0,
            'gtalk' => 0,
            'fb' => 0,
            'mac' => 0
        );

        $c = new Criteria();
        $allUsers = UserPeer::doSelect($c);

        $onlineusers = array();

        $this->fetchOnlineStatusFromIMBots();
        $this->fetchCCIds();

        /* @var $user User */
        foreach ($allUsers as $user) {

			// Rajesh Soni - 28 November 2012
			// Incorrect number of online tutors shown on the home page
			// the problem was that it didn't accurately show the number of tutors online. for example, there's only one tutor online if you go to the tutor list: http://www.rayku.com/tutors. But it's showing 7 on the home page

			$type = $user->getTypeName();
			if($type!='Expert')
				continue;

            if ($user->isOnline()) {
                $this->counts['web']++;
            } else if($this->isGtalkOnline($user)) {
                $this->counts['gtalk']++;
            } else if($this->isFBOnline($user)) {
                $this->counts['fb']++;
            } else if ($this->isMACOnline($user)) {
                $this->counts['mac']++;
            } else {
                continue;
            }

            $onlineusers[] = $user->getId();
        }

        return $onlineusers;
    }

    /**
     * Returns array with number of online users for each comunication channel
     */
    function getCountsByCC()
    {
        return $this->counts;
    }

    static function getOnlineUsersCount()
    {
        $cache = DataCache::getInstance();
        $count = $cache->get('onlineUsersTotalCount');

        if (1 || $count === null) {
            $uac = new UsersAvailabilityChecker;
            $count = count($uac->getOnlineUsers());
            $cache->set('onlineUsersTotalCount', $count, 60);
        }

        return $count;
    }

}

?>