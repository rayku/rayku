<?php

/**
 * The job of this class is to check current online/offline status of all users
 *
 * @author lukas
 */
class UsersAvailabilityChecker
{
    private function fetchOnlineStatusFromIMBots()
    {
        $facebookTutors = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
        $onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();
        $gtalkTutors = BotServiceProvider::createFor("http://www.rayku.com:8892/onlines")->getContent();

        $this->fbUsers = json_decode($facebookTutors, true);
        $this->botUsers = json_decode($onlineTutorsByNotificationBot, true);
        
        $gtalkUsers = json_decode($gtalkTutors, true);

        $this->gtalkUsers = array();
        
        foreach ($gtalkUsers as $gtalkUserId => $status) {
            $parts = explode('/', $gtalkUserId);
            $this->gtalkUsers[] = $parts[0];
        }
    }
    
    function isGtalkOnline(User $user)
    {
        $gtalk = $user->getUserGtalk();
        if ($gtalk && $gtalk->getGtalkid() != '') {
            return in_array($gtalk->getGtalkid(), $this->gtalkUsers);
        }
    }
    
    private function isFBOnline(User $user)
    {
        if (is_array($this->fbUsers)) {
            $fb_query = mysql_query("select * from user_fb where userid=" . $user->getId()) or die(mysql_error());

            if (mysql_num_rows($fb_query) > 0) {

                $fbRow = mysql_fetch_assoc($fb_query);
                $fb_username = $fbRow['fb_username'];

                foreach ($this->fbUsers as $fbUser) {
                    if ($fbUser['username'] == $fb_username) {
                        return true;
                    }
                }
            }
        }
    }
    
    private function isMACOnline(User $user)
    {
        if (is_array($this->botUsers)) {
            foreach ($this->botUsers as $botUser) {
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
        $c->addJoin(UserPeer::ID, UserGtalkPeer::USERID, Criteria::LEFT_JOIN);
        $allUsers = UserPeer::doSelect($c);

        $onlineusers = array();
        
        $this->fetchOnlineStatusFromIMBots();

        /* @var $user User */
        foreach ($allUsers as $user) {

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
    
    function getOnlineUsersCount()
    {
        $onlineUsersCount = count($this->getOnlineUsers());
        return $onlineUsersCount;
    }

}

?>