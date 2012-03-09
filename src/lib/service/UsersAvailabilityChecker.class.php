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
        $newUser = UserPeer::doSelect($c);

        $onlineusers = array();
        $offlineusers = array();
        $newOnlineUser = array();
        $newOfflineUser = array();

        $j = 0;
        $k = 0;
        $facebookTutors = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
        $onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();

        $Users = json_decode($facebookTutors, true);
        $_Users = json_decode($onlineTutorsByNotificationBot, true);


        foreach ($newUser as $new):


            $a = new Criteria();
            $a->add(UserPeer::ID, $new->getId());
            $users_online = UserPeer::doSelectOne($a);

            $onlinecheck = '';

            if ($users_online->isOnline()) {

                $onlinecheck = "online";
            }

            if (empty($onlinecheck)) {

                $gtalkquery = mysql_query("select * from user_gtalk where userid=" . $new->getId()) or die(mysql_error());

                if (mysql_num_rows($gtalkquery) > 0) {

                    $status = mysql_fetch_assoc($gtalkquery);

                    $gtalkmail = $status['gtalkid'];

                    $onlinecheck = BotServiceProvider::createFor('http://www.rayku.com:8892/status/' . $gtalkmail)->getContent();
                }
            }

            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($Users)) {

                $fb_query = mysql_query("select * from user_fb where userid=" . $new->getId()) or die(mysql_error());

                if (mysql_num_rows($fb_query) > 0) {

                    $fbRow = mysql_fetch_assoc($fb_query);

                    $fb_username = $fbRow['fb_username'];


                    foreach ($Users as $key => $user) :

                        if ($user['username'] == $fb_username):

                            $onlinecheck = 'online';

                            break;
                        endif;

                    endforeach;
                }
            }

            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($_Users)) {



                foreach ($_Users as $key => $_user) :

                    if ($_user['email'] == $users_online->getEmail()):

                        $onlinecheck = 'online';
                        break;
                    endif;

                endforeach;
            }



            if ($onlinecheck == "online") {

                $onlineusers[$j] = $new->getId();
                $j++;
            } elseif ($users_online->isOnline()) {
                $onlineusers[$j] = $new->getId();
                $j++;
            }

        endforeach;

        return count($onlineusers);
    }

}

?>