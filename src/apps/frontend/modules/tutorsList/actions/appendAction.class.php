<?php

/**
 */
class appendAction extends sfAction
{

    public function execute($request)
    {
        $c = new Criteria;
        $c->setLimit(15);
        $this->users = UserPeer::doSelect($c);
        
        if (count($this->users) < 1) {
            return sfView::ERROR;
        }
        
//        RaykuCommon::getDatabaseConnection();
//        
//        /* @var $currentUser User */
//        $currentUser = $this->getUser()->getRaykuUser();
//
//        $userId = $currentUser->getId();
//
//        $this->userId = $currentUser->getId();
//
//
//        $time = time();
//
//
//
//        $_SESSION["rateDisplay"] = 1;
//
//
//
//        if (!empty($_POST['hidden'])) {
//
//
//            $count = count($_POST['checkbox']);
//
//
//            /* Clearing Cookies */
//
//            for ($u = $_COOKIE['cookcount']; $u >= 1; $u--) {
//
//                $cookname = 'tutor_' . $u;
//
//                $this->getResponse()->setCookie($cookname, '', time() - 3600, '/', sfConfig::get('app_cookies_domain'));
//            }
//
//
//            $this->getResponse()->setCookie("tutorcount", '', time() - 3600, '/', sfConfig::get('app_cookies_domain'));
//
//            $this->getResponse()->setCookie("cookcount", '', time() - 3600, '/', sfConfig::get('app_cookies_domain'));
//
//            /* Clearing Cookies */
//
//            if ($count > 2) {
//
//                $close = 21000;
//            } else if ($count == 2) {
//
//                $close = 31000;
//            } else if ($count == 1) {
//
//                $close = 61000;
//            }
//
//            $j = 0;
//            for ($i = 0; $i < $count; $i++) {
//
//                mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close) VALUES ('" . $userId . "', '" . $_POST['checkbox'][$i] . "', '5', 'To be discussed','" . (++$j) . "', '" . $time . "', 1, " . $close . ") ") or die(mysql_error());
//            }
//
//
//
//            setcookie("asker_que", $_SESSION['question'], time() + 600, "/", sfConfig::get('app_cookies_domain'));
//
//            $this->getResponse()->setCookie("redirection", 1, time() + 600, '/', sfConfig::get('app_cookies_domain'));
//
//            $this->getResponse()->setCookie("forumsub", 1, time() + 600, '/', sfConfig::get('app_cookies_domain'));
//
//
//
//
//            $this->redirect('expertmanager/connect');
//        }
//
//
//
//        $this->cat = $this->getRequestParameter('category');
//
//        $this->course_id = @$_SESSION['tutcourse'];
//
//        if (empty($this->course_id)) {
//            $this->course_id = 1;
//        }
//
//
//        if (empty($this->cat)) {
//            $this->cat = 1;
//        }
//
//
//
//        $c = new Criteria();
//        $c->addJoin(ExpertCategoryPeer::USER_ID, UserTutorPeer::USERID, Criteria::INNER_JOIN);
//
//        if ($this->cat == 5) {
//            $experts = ExpertCategoryPeer::doSelect($c);
//        } else {
//            $c->add(ExpertCategoryPeer::CATEGORY_ID, $this->cat);
//            $experts = ExpertCategoryPeer::doSelect($c);
//        }
//
//        $_points = $currentUser->getPoints();
//
//
//        $newUser = array();
//        $i = 0;
//        $eachExpertOnlyOnce = array();
//
//        foreach ($experts as $exp) {
//
//            if (in_array($exp->getUserId(), $eachExpertOnlyOnce)) {
//                continue;
//            }
//
//            $eachExpertOnlyOnce[] = $exp->getUserId();
//
//            $_queryCourse = '';
//            $tutorsq = mysql_query("select * from tutor_profile where category = 1 and user_id = " . $exp->getUserId() . "") or die("Er-1-->" . mysql_error());
//            $tutors = mysql_fetch_array($tutorsq);
//            $tutor = '';
//
//            $tutor = explode("-", $tutors['course_id']);
//            $coursid = $this->course_id;
//            if (in_array($coursid, $tutor)) {
//                //echo $coursid;
//
//                $_queryCourse = mysql_query("select * from tutor_profile where category = 1 and user_id = " . $exp->getUserId() . "") or die("Er-1-->" . mysql_error());
//                //echo "select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."";
//            }
//
//
//
//            if ($_queryCourse && mysql_num_rows($_queryCourse) > 0) {
//
//                $query = mysql_query("select * from user_score where user_id=" . $exp->getUserId()) or die(mysql_error());
//                $score = mysql_fetch_assoc($query);
//
//                if ($score['score'] != 0) {
//
//                    if (false) { //$_points == '' || $_points == '0.00'   Temporary hack
//                        $emptyRCquery = mysql_query("select * from user_rate where userid=" . $exp->getUserId() . " and (rate = 0.00 || rate = 0) ") or die("Error In rate" . mysql_error());
//
//                        if (mysql_num_rows($emptyRCquery) > 0) {
//
//                            $dv = new Criteria();
//                            $dv->add(UserPeer::ID, $exp->getUserId());
//                            $_thisUser = UserPeer::doSelectOne($dv);
//
//                            $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
//
//                            $i++;
//                        }
//                    } else {
//
//                        $dv = new Criteria();
//                        $dv->add(UserPeer::ID, $exp->getUserId());
//                        $_thisUser = UserPeer::doSelectOne($dv);
//
//
//                        $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
//
//                        $i++;
//                    }
//                }
//            }
//        }
//
//
//
//
//        asort($newUser);
//
//        arsort($newUser);
//
//
//        $this->rankCheckUsers = $newUser;
//
//
//        ////if no online expert available redirecting to the board page
//
//
//        $onlineusers = array();
//        $offlineusers = array();
//
//        $newOnlineUser = array();
//        $newOfflineUser = array();
//        $j = 0;
//        $k = 0;
//        $facebookResponse = BotServiceProvider::createFor(sfConfig::get('app_facebook_url')."/tutor")->getContent();
//        $facebookUsers = json_decode($facebookResponse, true);
//        $botResponse = BotServiceProvider::createFor(sfConfig::get('app_notification_bot_url')."/tutor")->getContent();
//        $botUsers = json_decode($botResponse, true);
//
//        foreach ($newUser as $new) {
//
//            $a = new Criteria();
//            $a->add(UserPeer::ID, $new['userid']);
//            $users_online = UserPeer::doSelectOne($a);
//
//            $onlinecheck = '';
//
//            if ($users_online->isOnline()) {
//
//                $onlinecheck = "online";
//            }
//
//
//            if (empty($onlinecheck)) {
//                $userGtalk = $users_online->getUserGtalk();
//                if ($userGtalk) {
//                    $onlinecheck = BotServiceProvider::createFor(sfConfig::get('app_rayku_url').':'.sfConfig::get('app_g_chat_port').'/status/' . $userGtalk->getGtalkid())->getContent();
//                }
//            }
//
//            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($facebookUsers)) {
//
//                $userFb = UserFbPeer::retrieveByUserId($new['userid']);
//                if ($userFb) {
//                    $fb_username = $userFb->getFbUsername();
//
//                    foreach ($facebookUsers as $key => $user) {
//
//                        if ($user['username'] == $fb_username) {
//
//                            $onlinecheck = 'online';
//
//                            break;
//                        }
//
//                    }
//                }
//            }
//
//            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($botUsers)) {
//
//                foreach ($botUsers as $key => $_user) {
//
//                    if ($_user['email'] == $users_online->getEmail()){
//
//                        $onlinecheck = 'online';
//                        break;
//                    }
//
//                }
//            }
//
//
//
//            if ($onlinecheck == "online") {
//
//                $onlineusers[$j] = $new['userid'];
//
//                $newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat']);
//                $j++;
//            } elseif ($users_online->isOnline()) {
//
//                $newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat']);
//                $onlineusers[$j] = $new['userid'];
//
//                $j++;
//            } else {
//
//                $newOfflineUser[$k] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat']);
//                $offlineusers[$k] = $new['userid'];
//
//                $k++;
//            }
//
//        }
//
//        $this->newOnlineUser = $newOnlineUser;
//
//
//        $this->newOfflineUser = $newOfflineUser;
//
//
//        $this->_checkOnlineUsers = $onlineusers;
//
//
//
//
//        /////////////////////////////////////////////////////
//
//        if (isset($_COOKIE["onoff"]) && $_COOKIE["onoff"] == 1) {
//
//            if (!empty($_COOKIE["school"])) {
//
//                $cookieSchool = array();
//                $m = 0;
//                foreach ($newOnlineUser as $new) {
//
//                    $b = new Criteria();
//                    $b->add(UserPeer::ID, $new['userid']);
//                    $schoolusers = UserPeer::doSelectOne($b);
//                    $mail = explode("@", $schoolusers->getEmail());
//                    $newMail = explode(".", $mail[1]);
//
//                    if (($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
//
//                        $cookieSchool[$m] = $new;
//                        $m++;
//                    }
//
//                }
//
//                $this->expert_cats = $cookieSchool;
//            } else {
//                $this->expert_cats = $newOnlineUser;
//            }
//        } else if (isset($_COOKIE["onoff"]) && $_COOKIE["onoff"] == 2) {
//
//            if (!empty($_COOKIE["school"])) {
//
//                $cookieSchool = array();
//                $m = 0;
//
//                foreach ($newOfflineUser as $new) {
//
//                    $b = new Criteria();
//                    $b->add(UserPeer::ID, $new['userid']);
//                    $schoolusers = UserPeer::doSelectOne($b);
//                    $mail = explode("@", $schoolusers->getEmail());
//                    $newMail = explode(".", $mail[1]);
//
//                    if (($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
//
//                        $cookieSchool[$m] = $new;
//                        $m++;
//                    }
//
//                }
//
//                $this->expert_cats = $cookieSchool;
//            } else {
//
//                $this->expert_cats = $newOfflineUser;
//            }
//        } else {
//
//            if (!empty($_COOKIE["school"])) {
//
//                $cookieSchool = array();
//                $m = 0;
//
//                foreach ($newUser as $new) {
//
//                    $b = new Criteria();
//                    $b->add(UserPeer::ID, $new['userid']);
//                    $schoolusers = UserPeer::doSelectOne($b);
//                    $mail = explode("@", $schoolusers->getEmail());
//                    $newMail = explode(".", $mail[1]);
//                    if (($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
//                        $cookieSchool[$m] = $new;
//                        $m++;
//                    }
//
//                }
//
//                $this->expert_cats = $cookieSchool;
//            } else {
//
//                $this->expert_cats = $newUser;
//            }
//        }
//        $this->tutorsCount = count($this->expert_cats);
//
//        $c = new Criteria();
//        $c->add(CategoryPeer::ID, $this->cat);
//        $this->e = CategoryPeer::doSelectOne($c);
//    }
    }
}