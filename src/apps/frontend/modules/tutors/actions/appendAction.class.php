<?php

/**
 * friends actions.
 *
 * @package    elifes
 * @subpackage friends
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class appendAction extends sfAction
{

    public function execute($request)
    {
        $time_start = microtime(true);

        RaykuCommon::getDatabaseConnection();

        /* @var $currentUser User */
        $currentUser = $this->getUser()->getRaykuUser();

        $userId = $currentUser->getId();

        $this->userId = $currentUser->getId();


        $time = time();



        $_SESSION["rateDisplay"] = 1;



        if (!empty($_POST['hidden'])) {
            $count = count($_POST['checkbox']);


            /* Clearing Cookies */

            for ($u = $_COOKIE['cookcount']; $u >= 1; $u--) {

                $cookname = 'tutor_' . $u;

                $this->getResponse()->setCookie($cookname, '', time() - 3600, '/', sfConfig::get('app_cookies_domain'));
                echo $cookname.'--';
            }
            $this->getResponse()->setCookie("tutorcount", '', time() - 3600, '/', sfConfig::get('app_cookies_domain'));

            $this->getResponse()->setCookie("cookcount", '', time() - 3600, '/', sfConfig::get('app_cookies_domain'));

            /* Clearing Cookies */

            if ($count > 2) {

                $close = 21000;
            } else if ($count == 2) {

                $close = 31000;
            } else if ($count == 1) {

                $close = 61000;
            }

            $j = 0;
            for ($i = 0; $i < $count; $i++) {

                mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close) VALUES ('" . $userId . "', '" . $_POST['checkbox'][$i] . "', '5', 'To be discussed','" . (++$j) . "', '" . $time . "', 1, " . $close . ") ") or die(mysql_error());
            }



            setcookie("asker_que", $_SESSION['question'], time() + 600, "/", sfConfig::get('app_cookies_domain'));

            $this->getResponse()->setCookie("redirection", 1, time() + 600, '/', sfConfig::get('app_cookies_domain'));

            $this->getResponse()->setCookie("forumsub", 1, time() + 600, '/', sfConfig::get('app_cookies_domain'));




            $this->redirect('expertmanager/connect');
        }

        $this->cat = $this->getRequestParameter('category');

        $this->course_id = @$_SESSION['tutcourse'];

        if (empty($this->course_id)) {
            $this->course_id = 1;
        }


        if (empty($this->cat)) {
            $this->cat = 1;
        }
        
        if(strpos($currentUser->getEmail(), 'ryerson') === false){
        	$query = "SELECT * FROM tutor_profile t INNER JOIN user u ON u.id = t.user_id WHERE u.email NOT LIKE '%ryerson%'";
        	$experts=mysql_query($query);
        }else{
        	$experts=mysql_query("SELECT * FROM tutor_profile");
        }

        $_points = $currentUser->getPoints();


        $newUser = array();
        $i = 0;
        $eachExpertOnlyOnce = array();
        while($exp=mysql_fetch_array($experts)) {
            $user_id=$exp['user_id'];

            if (in_array($user_id, $eachExpertOnlyOnce)) {
                continue;
            }

            $eachExpertOnlyOnce[] = $user_id;

            $tutorsq = mysql_query("select * from tutor_profile where category = 1 and user_id = '" . $user_id . "'") or die("Er-1-->" . mysql_error());
            $tutors = mysql_fetch_array($tutorsq);
            $tutor = '';

            $tutor = explode("-", $tutors['course_id']);
            $coursid = $this->course_id;
            if (in_array($coursid, $tutor)) {
                //echo $coursid;

                $_queryCourse = mysql_query("select * from tutor_profile where category = 1 and user_id = '".$user_id ."'") or die("Er-1-->" . mysql_error());
                //echo "select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."";
            }
            if(isset($_queryCourse)){
                $query_Course_rows=mysql_num_rows($_queryCourse);
            }else{
                $query_Course_rows=0;
            }
            if ($query_Course_rows > 0) {

                $query = mysql_query("select * from user_score where user_id=" . $user_id) or die(mysql_error());
                $score = mysql_fetch_assoc($query);

                if ($score['score'] != 0) {

                    if (false) { //$_points == '' || $_points == '0.00'   Temporary hack
                        $emptyRCquery = mysql_query("select * from user_rate where userid='" . $user_id . "' and (rate = 0.00 || rate = 0) ") or die("Error In rate" . mysql_error());

                        if (mysql_num_rows($emptyRCquery) > 0) {

                            $dv = new Criteria();
                            $dv->add(UserPeer::ID, $user_id);
                            $_thisUser = UserPeer::doSelectOne($dv);

                            $newUser[$i] = array("score" => $score['score'], "userid" => $user_id, "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt(), "online" => $_thisUser->isOnline());

                            $i++;
                        }
                    } else {

                        $dv = new Criteria();
                        $dv->add(UserPeer::ID, $user_id);
                        $_thisUser = UserPeer::doSelectOne($dv);

                        if(isset($_thisUser)){
	                        $newUser[$i] = array("score" => $score['score'], "userid" => $user_id, "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt(), "online" => $_thisUser->isOnline());
	                        $i++;
                        }
                    }
                }
            }
        }
        asort($newUser);
        arsort($newUser);

        $this->rankCheckUsers = $newUser;

        $newOnlineUser = array();
        $newOfflineUser = array();
        $j = 0;
        $k = 0;
        $onlineusers = array();
        $offlineusers = array();
        foreach ($newUser as $new) {
            $tutor_status=mysql_fetch_array(mysql_query("SELECT * FROM tutor_profile WHERE user_id='$new[userid]'"));

            if ($tutor_status['online_status'] == '1' || $new['online']) {

                $onlineusers[$j] = $new['userid'];

                $newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat'], 'online' => $new['online']);
                $j++;
            } else {

                $newOfflineUser[$k] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat'], 'online' => $new['online']);
                $offlineusers[$k] = $new['userid'];

                $k++;
            }
        }

        $this->newOnlineUser = $newOnlineUser;
        $this->newOfflineUser = $newOfflineUser;
        $this->_checkOnlineUsers = $onlineusers;




        /////////////////////////////////////////////////////

        if (isset($_COOKIE["onoff"]) && $_COOKIE["onoff"] == 1) {

            if (!empty($_COOKIE["school"])) {

                $cookieSchool = array();
                $m = 0;
                foreach ($newOnlineUser as $new) {

                    $b = new Criteria();
                    $b->add(UserPeer::ID, $new['userid']);
                    $schoolusers = UserPeer::doSelectOne($b);
                    $mail = explode("@", $schoolusers->getEmail());
                    $newMail = explode(".", $mail[1]);

                    if (($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {

                        $cookieSchool[$m] = $new;
                        $m++;
                    }

                }

                $this->expert_cats = $cookieSchool;
            } else {
                $this->expert_cats = $newOnlineUser;
            }
        } else if (isset($_COOKIE["onoff"]) && $_COOKIE["onoff"] == 2) {

            if (!empty($_COOKIE["school"])) {

                $cookieSchool = array();
                $m = 0;

                foreach ($newOfflineUser as $new) {

                    $b = new Criteria();
                    $b->add(UserPeer::ID, $new['userid']);
                    $schoolusers = UserPeer::doSelectOne($b);
                    $mail = explode("@", $schoolusers->getEmail());
                    $newMail = explode(".", $mail[1]);

                    if (($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {

                        $cookieSchool[$m] = $new;
                        $m++;
                    }

                }

                $this->expert_cats = $cookieSchool;
            } else {

                $this->expert_cats = $newOfflineUser;
            }
        } else {
            if (!empty($_COOKIE["school"])) {

                $cookieSchool = array();
                $m = 0;

                foreach ($newUser as $new) {

                    $b = new Criteria();
                    $b->add(UserPeer::ID, $new['userid']);
                    $schoolusers = UserPeer::doSelectOne($b);
                    $mail = explode("@", $schoolusers->getEmail());
                    $newMail = explode(".", $mail[1]);
                    if (($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
                        $cookieSchool[$m] = $new;
                        $m++;
                    }

                }

                $this->expert_cats = $cookieSchool;
            } else {
                $this->expert_cats = $newUser;

            }
        }
        $this->tutorsCount = count($this->expert_cats);

        $c = new Criteria();
        $c->add(CategoryPeer::ID, $this->cat);
        $this->e = CategoryPeer::doSelectOne($c);

    }
}