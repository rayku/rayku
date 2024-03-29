<?php
/**
 * Description of appendAction
 */
class appendAction extends sfAction
{
    public function execute($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $this->userId = $currentUser->getId();
        $time = time();
        if (empty($_SESSION["course_id"])) {
            $_SESSION["course_id"] = '1';
        }

        $this->cat = $this->getRequestParameter('category');
        $this->course_id = $this->getRequestParameter('course');

        if (empty($this->course_id)) {
            if (!empty($_SESSION['course_id'])) {
                $this->course_id = $_SESSION['course_id'];
            } else {
                $this->course_id = 1;
            }
        } else {
            $_SESSION['course_id'] = $this->course_id;
        }

        if (empty($this->cat)) {
            if (!empty($_SESSION['subject'])) {
                $this->cat = $_SESSION['subject'];
            } else {
                $this->cat = 1;
            }
        } else {
            $_SESSION['subject'] = $this->cat;
        }

        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

        $c = new Criteria();
        $c->addJoin(ExpertCategoryPeer::USER_ID, UserTutorPeer::USERID, Criteria::INNER_JOIN);
        
        if ($this->cat == 5) {
            $experts = ExpertCategoryPeer::doSelect($c);
        } else {
            $c->add(ExpertCategoryPeer::CATEGORY_ID,$this->cat);
            $experts = ExpertCategoryPeer::doSelect($c);
        }
        $queryPoints = mysql_query("select * from user where id = ".$userId, $connection) or die("Error In rate".mysql_error());
        if (mysql_num_rows($queryPoints) > 0) {
            $rowPoints = mysql_fetch_assoc($queryPoints);
            $_points = $rowPoints['points'];
        }
        
        $newUser= array();
        $i =0;
        $eachExpertOnlyOnce= array();

        foreach ($experts as $exp) {
            if ($userId != $exp->getUserId()) {
                if (in_array($exp->getUserId(), $eachExpertOnlyOnce)) {
                    continue;
                }
                $eachExpertOnlyOnce[] = $exp->getUserId();
                
                /* Testing - Student match with Tutors */
                $_queryCourse = '';

                $tutorsq = mysql_query("select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."", $connection) or die("Er-1-->".mysql_error());
                $tutors = mysql_fetch_array($tutorsq);
                $tutor ='';

                $tutor = explode("-",$tutors['course_id']);
                if (in_array($_SESSION["course_id"],$tutor)) {
                    $_queryCourse = mysql_query("select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."", $connection) or die("Er-1-->".mysql_error());
                    //echo "select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."";
                }
                if (@mysql_num_rows($_queryCourse) > 0) {
                    $query = mysql_query("select * from user_score where user_id = ".$exp->getUserId(), $connection) or die(mysql_error());
                    $score = mysql_fetch_assoc($query);

                    if ($score['score'] != 0) {
                        if ($_points == '' || $_points == '0.00' ) {
                            $emptyRCquery = mysql_query("select * from user_rate where userid = ".$exp->getUserId()." and (rate = 0.00 || rate = 0) ", $connection) or die("Error In rate".mysql_error());
                            if (mysql_num_rows($emptyRCquery) > 0) {
                                $dv = new Criteria();
                                $dv->add(UserPeer::ID,$exp->getUserId());
                                $_thisUser = UserPeer::doSelectOne($dv);
                                $rankUsersFinal[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
                                $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
                                $i++;
                            }
                        } else {
                            $dv = new Criteria();
                            $dv->add(UserPeer::ID,$exp->getUserId());
                            $_thisUser = UserPeer::doSelectOne($dv);
                            $rankUsersFinal[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
                            $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
                            $i++;
                        }
                    }
                }

            }
        }
        asort($newUser);
        arsort($newUser);
        asort($rankUsersFinal);
        arsort($rankUsersFinal);

        $this->rankCheckUsers = $rankUsersFinal;
        ////if no online expert available redirecting to the board page
        
        // // ant-edit remove for now
         $onlineusers = array();  $offlineusers = array();
         $newOnlineUser = array();  $newOfflineUser = array();
         $j = 0; $k = 0;
        // $facebookTutors = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
        // $onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();

        foreach ($newUser as $new) {
            $a = new Criteria();
            $a->add(UserPeer::ID,$new['userid']);
            $users_online = UserPeer::doSelectOne($a);

            $onlinecheck = '';

            if ($users_online->isOnline()) {
                $onlinecheck = "online";
            }

            // ant-edit remove for now
            if (empty($onlinecheck)) {
                $userGtalk = $users_online->getUserGtalk();
                if ($userGtalk) { 
                    $onlinecheck = BotServiceProvider::createFor(sfConfig::get('app_rayku_url') .':'.sfConfig::get('app_g_chat_port').'/status/'.$userGtalk->getGtalkid())->getContent();
	        // echo 'hello '  . $onlinecheck     ; 
		}
            }

            // if (empty($onlinecheck) || ($onlinecheck != "online")) {
            //     $userFb = UserFbPeer::retrieveByUserId($new['userid']);
            //     if ($userFb) {
            //         $fb_username = $userFb->getFbUsername();
            //         $Users = json_decode($facebookTutors, true);
            //         foreach ($Users as $key => $user) {
            //             if ($user['username'] == $fb_username) {
            //                 $onlinecheck = 'online';
            //                 break;
            //             }
            //         }
            //     }
            // }
            // if (empty($onlinecheck) || ($onlinecheck != "online")) {
            //     $_Users = json_decode($onlineTutorsByNotificationBot, true);
            //     foreach ($_Users as $key => $_user) {
            //         if ($_user['email'] == $users_online->getEmail()) {
            //             $onlinecheck = 'online';
            //             break;
            //         }
            //     }
            // }

            if ($onlinecheck == "online") {
                $onlineusers[$j] = $new['userid'];
                $newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat']);
                $j++;
            } elseif ($users_online->isOnline()) {
                $newOnlineUser[$j] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat']);
                $onlineusers[$j] = $new['userid'];
                $j++;
            } else {
                $newOfflineUser[$k] = array("score" => $new['score'], "userid" => $new['userid'], "category" => $new['category'], "createdat" => $new['createdat']);
                $offlineusers[$k] = $new['userid'];
                $k++;
            }
        }

        $this->newOnlineUser = $newOnlineUser;
        $this->newOfflineUser = $newOfflineUser;
        $this->_checkOnlineUsers = $onlineusers;
        if (count($onlineusers) < 1) {
            $this->redirect('/forum/newthread/'.$_SESSION['subject'].'?exp_online = 1');
        }
        
        $onoff = isset($_COOKIE["onoff"]) ? $_COOKIE["onoff"] : null;
        if ($onoff == 1) {
            if (!empty($_COOKIE["school"])) {
                $cookieSchool = array(); $m =0;
                foreach ($newOnlineUser as $new) {
                    $b = new Criteria();
                    $b->add(UserPeer::ID,$new['userid']);
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
        } else if ($onoff == 2) {
            if (!empty($_COOKIE["school"])) {
                $cookieSchool = array(); $m =0;
                foreach ($newOfflineUser as $new) {
                    $b = new Criteria();
                    $b->add(UserPeer::ID,$new['userid']);
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
                $cookieSchool = array(); $m =0;
                foreach ($newUser as $new) {
                    $b = new Criteria();
                    $b->add(UserPeer::ID,$new['userid']);
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
        $c->add(CategoryPeer::ID,$this->cat);
        $this->e = CategoryPeer::doSelectOne($c);
    }
}
