<?php
/**
 * List of tutors displayed after student asks question
 */
class listAction extends sfAction
{
    public function execute($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $this->userId = $currentUser->getId();
        $time = time();
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

        if (empty($_SESSION["course_id"])) {
            $_SESSION["course_id"] = '1';
        }

        /* Quick Registration Users - Listing Tutors */
        if ($this->studentFromQuickRegistrationAskingAQuestion()) {
            $_dash_question = '';  $_dash_course_id = '';   $_school = '';  $_dash_education = ''; $_dash_code_id = '';  $_dash_year = '';
            $_SESSION['subject'] = 1;
            $_dash_education = $_SESSION['edu'];
            $_dash_course_id = $_SESSION['course_id'];
            if ($_dash_course_id) {
                $queryCname = mysql_query("select * from courses where id ='".$_dash_course_id."'", $connection) or die(mysql_error());
                $rowCoursename = mysql_fetch_array($queryCname);
                $_SESSION['course_name_sess'] = $rowCoursename['course_name'];
            }


            if (strtolower($_SESSION['year']) != "Choose year") {
                $_dash_year = trim($_SESSION['year']);
            } elseif (strtolower($_SESSION['grade']) != "Choose grade") {
                $_dash_year = trim($_SESSION['grade']);
            }

            $c = new Criteria;
            $c->add(UserQuestionTagPeer::CATEGORY_ID, 1);
            $c->add(UserQuestionTagPeer::USER_ID, $userId);
            $c->add(UserQuestionTagPeer::COURSE_ID, $_dash_course_id);
            $c->add(UserQuestionTagPeer::COURSE_CODE, $_dash_code_id);
            $c->add(UserQuestionTagPeer::EDUCATION, $_dash_education);
            $c->add(UserQuestionTagPeer::SCHOOL, $_school);
            $c->add(UserQuestionTagPeer::YEAR, $_dash_year);
            $userQuestionTag = UserQuestionTagPeer::doSelectOne($c);
            if ($userQuestionTag) {
                $userQuestionTag->delete();
            }
            
            $userQuestionTag = new UserQuestionTag;
            $userQuestionTag->setUserId($userId);
            $userQuestionTag->setCategoryId(1);
            $userQuestionTag->setCourseId($_dash_course_id);
            $userQuestionTag->setCourseCode($_dash_code_id);
            $userQuestionTag->setEducation($_dash_education);
            $userQuestionTag->setSchool($_school);
            $userQuestionTag->setYear($_dash_year);
            $userQuestionTag->setQuestion($_SESSION['question']);
            $userQuestionTag->save();

        } else if ($this->loggedStudentAsksAQuestion()) {
            $_dash_question = '';  $_dash_course_id = '';   $_school = '';  $_dash_education = ''; $_dash_code_id = '';  $_dash_year = '';

            $_dash_question = $_POST['question'];

            $_SESSION['question'] = $_dash_question;
            $_SESSION['subject'] = 1;

            if (!empty($_POST['course_category_hidden'])) {
                $course_name = trim($_POST['course_category_hidden']);
                $_SESSION['course_name_sess'] = $course_name;
                $_queryCourse = mysql_query("select * from courses where course_name ='".$course_name."' ", $connection) or die(mysql_error());
                $_rowCourse = mysql_fetch_assoc($_queryCourse);

                $_dash_course_id = $_rowCourse['id'];

                $_SESSION["course_id"]  = $_dash_course_id;
            }
            $_dash_education = $_POST['edu'];
            /* Student Confirmation */
            $_SESSION['edu'] = $_dash_education;

            if ( strtolower($_POST['year_hidden']) != "choose year") {
                $_dash_year = trim($_POST['year_hidden']);
                /* student confirmation */
                $_SESSION['year'] = $_dash_year;
            } elseif (strtolower($_POST['grade_hidden']) != "choose grade") {
                $_dash_year = trim($_POST['grade_hidden']);
                /* student confirmation */
                $_SESSION['grade'] = $_dash_year;
            }
            
            $c = new Criteria;
            $c->add(UserQuestionTagPeer::CATEGORY_ID, 1);
            $c->add(UserQuestionTagPeer::USER_ID, $userId);
            $c->add(UserQuestionTagPeer::COURSE_ID, $_dash_course_id);
            $c->add(UserQuestionTagPeer::COURSE_CODE, $_dash_code_id);
            $c->add(UserQuestionTagPeer::EDUCATION, $_dash_education);
            $c->add(UserQuestionTagPeer::SCHOOL, $_school);
            $c->add(UserQuestionTagPeer::YEAR, $_dash_year);
            $userQuestionTag = UserQuestionTagPeer::doSelectOne($c);
            if ($userQuestionTag) {
                $userQuestionTag->delete();
            }
            
            $userQuestionTag = new UserQuestionTag;
            $userQuestionTag->setUserId($userId);
            $userQuestionTag->setCategoryId(1);
            $userQuestionTag->setCourseId($_dash_course_id);
            $userQuestionTag->setCourseCode($_dash_code_id);
            $userQuestionTag->setEducation($_dash_education);
            $userQuestionTag->setSchool($_school);
            $userQuestionTag->setYear($_dash_year);
            $userQuestionTag->setQuestion($_POST['question']);
            $userQuestionTag->save();
        }

        /**
         * @todo - below block of code could be extracted to separate action 
         */
        if (!empty($_POST['hidden'])) {
            $count = count($_POST['checkbox']);
            /* Clearing Cookies */
            if (isset($_COOKIE['cookcount'])) {
                for ($u = $_COOKIE['cookcount']; $u >= 1; $u--) {
                    $cookname =  'expert_'.$u;
                    setcookie($cookname,'', time()-3600, "/expertmanager/");
                }
            }

            setcookie("expertscount",'', time()-3600, "/expertmanager/");
            setcookie("cooktotal",'', time()-3600, "/expertmanager/");

            /* Clearing Cookies */

            if ($count == 4) {
                $close = 46000;
                $_SESSION['connected_tutors'] = 4;
            } else if ($count == 3) {
                $close = 46000;
                $_SESSION['connected_tutors'] = 3;
            } else if ($count == 2) {
                $close = 61000;
                $_SESSION['connected_tutors'] = 2;
            } else if ($count == 1) {
                $close = 61000;
                $_SESSION['connected_tutors'] = 1;
            } else {
                $close = 61000;
                $_SESSION['connected_tutors'] = 1;
            }

            $j = 0;
            
            $c = new Criteria;
            $c->add(UserQuestionTagPeer::USER_ID, $userId);
            $c->addDescendingOrderByColumn(UserQuestionTagPeer::ID);
            $userQuestionTag = UserQuestionTagPeer::doSelectOne($c);
                    
            $course_code = '';
            $year = '';
            $course_id = '1';
            $school = '';
            
            if ($userQuestionTag) {
                $course_id = $userQuestionTag->getCourseId();
                $course_code = $userQuestionTag->getCourseCode();
                $year = $userQuestionTag->getYear();
                $school = $userQuestionTag->getSchool();

                if ($userQuestionTag->getEducation() == 2) {
                    $school = "High School";
                }
            }

            for ($i = 0; $i < $count; $i++) {
                mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, course_id, `question`, `exe_order`, `time`,course_code, year, school, status, close) VALUES ('".$userId."', '".$_POST['checkbox'][$i]."', ".$this->cat.", ".$course_id.",'".$_SESSION['question']."','".(++$j)."', '".$time."', '".$course_code."', '".$year."', '".$school."', 1, ".$close.") ", $connection) or die("Error In Insert-->".mysql_error());
            }

            /* Notify same tutor again */

            $l = 0;
            $source = 'expertmanager';
            mysql_query("DELETE FROM `student_questions` WHERE user_id = ".$userId."", $connection);

            for ($i = 0; $i < $count; $i++) {
                $question = new StudentQuestion();
                $question->setStudentId($userId);
                $question->setTutorId($_POST['checkbox'][$i]);
                $question->setCategoryId($this->cat);
                $question->setCourseId($course_id);
                $question->setQuestion($_SESSION['question']);
                $question->setExeOrder(++$l);
                $question->setTime($time);
                $question->setCourseCode($course_code);
                $question->setYear($year);
                $question->setSchool($school);
                $question->setStatus(1);
                $question->setClose($close);
                $question->setSource($source);
                $question->save();
            }

            setcookie("asker_que", urldecode($_SESSION['question']), time()+600, "/", sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie("redirection", 1,time()+600, '/', sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie("forumsub", $_SESSION['subject'],time()+600, '/', sfConfig::get('app_cookies_domain'));

            $this->redirect('expertmanager/connect');
        }

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

                $_queryCourse = '';

                $tutorsq = mysql_query("select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."", $connection) or die("Er-1-->".mysql_error());
                $tutors = mysql_fetch_array($tutorsq);
                $tutor ='';
                $tutor = explode("-",$tutors['course_id']);
                if (in_array($_SESSION["course_id"],$tutor)) {
                    $_queryCourse = mysql_query("select * from tutor_profile where category = 1 and user_id = ".$exp->getUserId()."", $connection) or die("Er-1-->".mysql_error());
                }


                if ($_queryCourse && mysql_num_rows($_queryCourse) > 0) {
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
        $onlineusers = array();  $offlineusers = array();
        $newOnlineUser = array();  $newOfflineUser = array();
        $j = 0; $k = 0;
        $facebookTutors = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
        $onlineTutorsByNotificationBot = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();
        $Users = json_decode($facebookTutors, true);
        $_Users = json_decode($onlineTutorsByNotificationBot, true);

        foreach ($newUser as $new) {
            $a = new Criteria();
            $a->add(UserPeer::ID,$new['userid']);
            $users_online = UserPeer::doSelectOne($a);

            $onlinecheck = '';
            if ($users_online->isOnline()) {
                $onlinecheck = "online";
            }

            if (empty($onlinecheck)) {
                $userGtalk = $users_online->getUserGtalk();
                if ($userGtalk) {
                    $onlinecheck = BotServiceProvider::createFor('http://www.rayku.com:8892/status/'.$userGtalk->getGtalkid())->getContent();
                }
            }

            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($Users)) {
                $userFb = UserFbPeer::retrieveByUserId($new['userid']);
                if ($userFb) {
                    $fb_username = $userFb->getFbUsername();
                    foreach ($Users as $key => $user) {
                        if ($user['username'] == $fb_username) {
                            $onlinecheck = 'online';
                            break;
                        }
                    }
                }
            }

            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($_Users)) {
                foreach ($_Users as $key => $_user) {
                    if ($_user['email'] == $users_online->getEmail()) {
                        $onlinecheck = 'online';
                        break;
                    }
                }
            }

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
            $this->redirect('http://'.RaykuCommon::getCurrentHttpDomain().'/forum/newthread/'.$_SESSION['subject'].'?exp_online = 1');
        }

        $onoff = isset($_COOKIE['onoff']) ? $_COOKIE['onoff'] : null;
        if ($onoff == 1) {
            if (!empty($_COOKIE["school"])) {
                $cookieSchool = array(); $m =0;
                foreach ($newOnlineUser as $new){
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
                foreach ($newOfflineUser as $new){
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
                foreach ($newUser as $new){
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

    private function studentFromQuickRegistrationAskingAQuestion()
    {
        return !empty($_SESSION['dash_hidden']);
    }

    private function loggedStudentAsksAQuestion()
    {
        return !empty($_POST['dash_hidden']);
    }
}