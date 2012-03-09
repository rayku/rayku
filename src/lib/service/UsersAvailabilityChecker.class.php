<?php

/**
 * The job of this class is to check current online/offline status of users
 *
 * @author lukas
 */
class UsersAvailabilityChecker
{

    function getOnlineUsersCount()
    {
        $c = new Criteria();
        $allUsers = UserPeer::doSelect($c);

        $onlineusers = array();

        $facebookTutors = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
        $onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();

        $fbUsers = json_decode($facebookTutors, true);
        $botUsers = json_decode($onlineTutorsByNotificationBot, true);


        /* @var $user User */
        foreach ($allUsers as $user) {
            if ($user->isOnline()) {
                $onlineusers[] = $user->getId();
                continue;
            }

            $gtalkquery = mysql_query("select * from user_gtalk where userid=" . $user->getId()) or die(mysql_error());

            if (mysql_num_rows($gtalkquery) > 0) {

                $status = mysql_fetch_assoc($gtalkquery);

                $gtalkmail = $status['gtalkid'];

                $onlinecheck = BotServiceProvider::createFor('http://www.rayku.com:8892/status/' . $gtalkmail)->getContent();
                if ($onlinecheck == 'online') {
                    $onlineusers[] = $user->getId();
                    continue;
                }
            }


            if (is_array($fbUsers)) {
                $fb_query = mysql_query("select * from user_fb where userid=" . $user->getId()) or die(mysql_error());

                if (mysql_num_rows($fb_query) > 0) {

                    $fbRow = mysql_fetch_assoc($fb_query);
                    $fb_username = $fbRow['fb_username'];

                    foreach ($fbUsers as $key => $fbUser) {
                        if ($fbUser['username'] == $fb_username) {
                            $onlineusers[] = $user->getId();
                            continue 2;
                        }
                    }
                }
            }

            if (is_array($botUsers)) {
                foreach ($botUsers as $key => $botUser) {
                    if ($botUser['email'] == $user->getEmail()) {
                        $onlineusers[] = $user->getId();
                        continue 2;
                    }
                }
            }
        }

        return count($onlineusers);
    }

}

?>