<?php
/**
 * expertmanager actions.
 *
 * @package    elifes
 * @subpackage expertmanager
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class listAction extends sfAction
{
    public function execute($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
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

        if (empty($_SESSION["asker_year"])) {
            $_SESSION["asker_year"] = '';
        }

        if (empty($_SESSION["asker_school"])) {
            $_SESSION["asker_school"] = '';
        }

        /* Quick Registration Users - Listing Tutors */
        if ($this->studentFromQuickRegistrationAskingAQuestion()) {
            $_dash_question = '';  $_dash_course_id = '';   $_school = '';  $_dash_education = ''; $_dash_code_id = '';  $_dash_year = '';
            $_year = '';
            $_asker_cc_id = '';   $_asker_year = '';  $_asker_school = '';
            $_SESSION['subject'] = 1;
            $_dash_education = $_SESSION['edu'];
            $_dash_course_id = $_SESSION['course_id'];
            if ($_dash_course_id) {
                $queryCname = mysql_query("select * from courses where id ='".$_dash_course_id."'", $connection) or die(mysql_error());
                $rowCoursename = mysql_fetch_array($queryCname);
                $_SESSION['course_name_sess'] = $rowCoursename['course_name'];
            }

            if ($_dash_education == 1) {
                $_school = trim($_SESSION['name']);
                if ($_school == "University of Toronto") {
                    $_SESSION["asker_school"] = "utoronto";
                } elseif ($_school == "UBC University of British Columbia") {
                    $_SESSION["asker_school"] = "ubc";
                } elseif ($_school == "University of British Columbia") {
                    $_SESSION["asker_school"] = "ubc";
                }
            } elseif ($_dash_education == 2) {
                $_SESSION["asker_school"] = "High School";
            }

            if ($_SESSION['course_code'] != "Course Code" ) {
                $_dash_code_id = trim($_SESSION['course_code']);
                $_queryCourseCode = mysql_query("select * from course_sub where course_code ='".$_dash_code_id."' ", $connection) or die(mysql_error());
                $_rowCourseCode = mysql_fetch_assoc($_queryCourseCode);
                $_SESSION["asker_cc_id"] = $_rowCourseCode['id'];
            }

            if (strtolower($_SESSION['year']) != "Choose year") {
                $_dash_year = trim($_SESSION['year']);
                if ($_dash_year == "1st Year") {
                    $_SESSION["asker_year"] = '1';
                } elseif ($_dash_year == "2nd Year") {
                    $_SESSION["asker_year"] = '2';
                } elseif ($_dash_year == "3rd Year") {
                    $_SESSION["asker_year"] = '3';
                } else {
                    $_SESSION["asker_year"] = '4';
                }
            } elseif (strtolower($_SESSION['grade']) != "Choose grade") {
                $_dash_year = trim($_SESSION['grade']);
            }

            $_queryTag = mysql_query("select * from user_question_tag where category_id = 1 and user_id = ".$userId." and course_id = ".$_dash_course_id." and education = ".$_dash_education." and school = '".$_school."' and year = '".$_dash_year."' and course_code ='".$_dash_code_id."' ", $connection) or die("Error-->1".mysql_error());

            if (mysql_num_rows($_queryTag) > 0) 	{
                $_rowDelete = mysql_fetch_assoc($_queryTag);
                mysql_query("delete from user_question_tag where id =".$_rowDelete['id'], $connection) or die(mysql_error());
            }

            mysql_query("INSERT INTO `rayku_db`.`user_question_tag` (`user_id`, `category_id`, `course_id`, `course_code`, `education`, `school`, `year`,`question`) VALUES (".$userId.", '1', ".$_dash_course_id.", '".$_dash_code_id."', ".$_dash_education.", '".$_school."', '".$_dash_year."','".$_SESSION['question']."')", $connection) or die("Error In Tag Insert--->".mysql_error());

        } else if ($this->loggedStudentAsksAQuestion()) {
            $_dash_question = '';  $_dash_course_id = '';   $_school = '';  $_dash_education = ''; $_dash_code_id = '';  $_dash_year = '';
            $_year = '';

            $_asker_cc_id = '';   $_asker_year = '';  $_asker_school = '';

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

            if ($_dash_education == 1) {
                $_school = trim($_POST['name']);
                if ($_school == "University of Toronto") {
                    $_SESSION["asker_school"] = "utoronto";
                } elseif ($_school == "UBC University of British Columbia") {
                    $_SESSION["asker_school"] = "ubc";
                } elseif ($_school == "University of British Columbia") {
                    $_SESSION["asker_school"] = "ubc";
                }
            } elseif ($_dash_education == 2) {
                $_SESSION["asker_school"] = "High School";
            }

            if (strtolower($_POST['course_code_hidden']) != "choose code" ) {
                $_dash_code_id = trim($_POST['course_code_hidden']);
                $_SESSION['course_code'] = trim($_dash_code_id);
                $_queryCourseCode = mysql_query("select * from course_sub where course_code ='".$_dash_code_id."' ", $connection) or die(mysql_error());
                $_rowCourseCode = mysql_fetch_assoc($_queryCourseCode);

                $_SESSION["asker_cc_id"] = $_rowCourseCode['id'];
            }

            if ( strtolower($_POST['year_hidden']) != "choose year") {
                $_dash_year = trim($_POST['year_hidden']);
                /* student confirmation */
                $_SESSION['year'] = $_dash_year;

                if ($_dash_year == "1st Year") {
                    $_SESSION["asker_year"] = '1';
                } elseif ($_dash_year == "2nd Year") {
                    $_SESSION["asker_year"] = '2';
                } elseif ($_dash_year == "3rd Year") {
                    $_SESSION["asker_year"] = '3';
                } else {
                    $_SESSION["asker_year"] = '4';
                }
            } elseif (strtolower($_POST['grade_hidden']) != "choose grade") {
                $_dash_year = trim($_POST['grade_hidden']);
                /* student confirmation */
                $_SESSION['grade'] = $_dash_year;
            }
            $_queryTag = mysql_query("select * from user_question_tag where category_id = 1 and user_id = ".$userId." and course_id = ".$_dash_course_id." and education = ".$_dash_education." and school = '".$_school."' and year = '".$_dash_year."' and course_code ='".$_dash_code_id."' ", $connection) or die("Error-->1".mysql_error());
            if (mysql_num_rows($_queryTag) > 0) 	{
                $_rowDelete = mysql_fetch_assoc($_queryTag);
                mysql_query("delete from user_question_tag where id =".$_rowDelete['id'], $connection) or die(mysql_error());
            }

            mysql_query("INSERT INTO `rayku_db`.`user_question_tag` (`user_id`, `category_id`, `course_id`, `course_code`, `education`, `school`, `year`,`question`) VALUES (".$userId.", '1', ".$_dash_course_id.", '".$_dash_code_id."', ".$_dash_education.", '".$_school."', '".$_dash_year."','".$_POST['question']."')", $connection) or die("Error In Tag Insert--->".mysql_error());
        }

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
            $_queryFetch = mysql_query("select * from user_question_tag where user_id = ".$userId." order by id desc", $connection) or die("Error-->1".mysql_error());

            $course_code = ''; 			$year = ''; $course_id = '1'; $school = '';
            if (mysql_num_rows($_queryFetch) > 0) {
                $_rowFetch = mysql_fetch_assoc($_queryFetch);
                $course_id = $_rowFetch['course_id'];
                $course_code = $_rowFetch['course_code'];
                $year = $_rowFetch['year'];
                $school =  $_rowFetch['school'];

                if ($_rowFetch['education'] == 2) {
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
                mysql_query("INSERT INTO `student_questions` (`user_id`, `checked_id`, `category_id`, course_id, `question`, `exe_order`, `time`,course_code, year, school, status, close, source) VALUES ('".$userId."', '".$_POST['checkbox'][$i]."', '".$this->cat."', '".$course_id."','".$_SESSION['question']."','".(++$l)."', '".$time."', '".$course_code."', '".$year."', '".$school."', 1, '".$close."', '".$source."')", $connection) or die("Error In Insert-->".mysql_error());
            }

            // Connect Whiteboard //
            $insSQL = "INSERT INTO `log_user_whiteboard` (
                `id` ,
                `user_id` ,
                `whiteboard_date_time`
            )
            VALUES (
                NULL ,
                '".$logedUserId."',
                '".date("Y-m-d H:i:s")."'
            );";
            mysql_query($insSQL, $connection);

            // Connect Whiteboard //
            setcookie("asker_que", urldecode($_SESSION['question']), time()+600, "/");
            $this->getResponse()->setCookie("redirection", 1,time()+600);
            $this->getResponse()->setCookie("forumsub", $_SESSION['subject'],time()+600);
            $this->redirect('expertmanager/connect');
        }

        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        $c = new Criteria();
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
        $newUser= array(); $i =0; $newUserLimit= array();

        foreach ($experts as $exp) {
            if ($userId != $exp->getUserId()) {
                if (!in_array($exp->getUserId(), $newUserLimit)) {
                    $newUserLimit[] = $exp->getUserId();

                    $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ", $connection) or die(mysql_error());
                    if (mysql_num_rows($_query) > 0) {
                        /* Testing - Student match with Tutors */
                        $usrname = $this->getUser()->getRaykuUser()->getUsername();
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
                                        if (!empty($_SESSION["asker_year"])) {

                                            $queryExp = mysql_query("select * from user_course where user_id = ".$exp->getUserId()." AND course_subject = ".$this->cat, $connection) or die("Er-2-->".mysql_error());
                                            $rowExp = mysql_fetch_assoc($queryExp);

                                            if (!is_numeric($rowExp['course_year'])) {
                                                if ($rowExp['course_year'] == "graduated") {
                                                    $rowExp['course_year'] = 5;
                                                } else {
                                                    $rowExp['course_year'] = 4;
                                                }
                                            }
                                            $valueYear = $rowExp['course_year']  - $_SESSION["asker_year"];

                                            if ($valueYear == 1 || $valueYear == 2 || $valueYear == 3) {
                                                $score['score'] = $score['score'] * 1.2;

                                            } else if ($valueYear == 4) {
                                                $score['score'] = $score['score'] * 1.1;
                                            }
                                        }

                                        if (!empty($_SESSION["asker_cc_id"])) {
                                            $_queryCourseCode = mysql_query("select * from expert_course_code where user_id =".$exp->getUserId()." and  course_code_id = ".$_SESSION["asker_cc_id"]." ", $connection) or die("Er-3-->".mysql_error());
                                            if (mysql_num_rows($_queryCourseCode) > 0) {
                                                $score['score'] = $score['score'] * 1.5;
                                            }
                                        }

                                        if (!empty($_SESSION["asker_school"])) {
                                            $mailUser = explode("@", $_thisUser->getEmail());
                                            $newMailUser = explode(".", $mailUser[1]);
                                            if (($newMailExperts[0] == $_SESSION["asker_school"]) || ($newMailExperts[1] == $_SESSION["asker_school"])) {
                                                $score['score'] = $score['score'] * 1.5;
                                            }
                                        }

                                        $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
                                        $i++;
                                    }
                                } else {
                                    $dv = new Criteria();
                                    $dv->add(UserPeer::ID,$exp->getUserId());
                                    $_thisUser = UserPeer::doSelectOne($dv);

                                    $rankUsersFinal[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());

                                    if (!empty($_SESSION["asker_year"])) {
                                        $queryExp = mysql_query("select * from user_course where user_id = ".$exp->getUserId()." AND course_subject = ".$this->cat, $connection) or die("Er-4-->".mysql_error());
                                        $rowExp = mysql_fetch_assoc($queryExp);

                                        if (!is_numeric($rowExp['course_year'])) {
                                            if ($rowExp['course_year'] == "graduated") {
                                                $rowExp['course_year'] = 5;
                                            } else {
                                                $rowExp['course_year'] = 4;
                                            }
                                        }
                                        $valueYear = $rowExp['course_year']  - $_SESSION["asker_year"];

                                        if ($valueYear == 1 || $valueYear == 2 || $valueYear == 3) {
                                            $score['score'] = $score['score'] * 1.2;
                                        } else if ($valueYear == 4) {
                                            $score['score'] = $score['score'] * 1.1;
                                        }
                                    }

                                    if (!empty($_SESSION["asker_cc_id"])) {
                                        $_queryCourseCode = mysql_query("select * from expert_course_code where user_id =".$exp->getUserId()." and  course_code_id = ".$_SESSION["asker_cc_id"]." ", $connection) or die("Er-5-->".mysql_error());
                                        if (mysql_num_rows($_queryCourseCode) > 0) {
                                            $score['score'] = $score['score'] * 1.5;
                                        }
                                    }
                                    if (!empty($_SESSION["asker_school"])) {
                                        $mailUser = explode("@", $_thisUser->getEmail());
                                        $newMailUser = explode(".", $mailUser[1]);
                                        if (($newMailExperts[0] == $_SESSION["asker_school"]) || ($newMailExperts[1] == $_SESSION["asker_school"])) {
                                            $score['score'] = $score['score'] * 1.5;
                                        }
                                    }
                                    $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());
                                    $i++;
                                }
                            }
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
                    $onlinecheck = BotServiceProvider::createFor('http://'.RaykuCommon::getCurrentHttpDomain().':8892/status/'.$userGtalk->getGtalkid())->getContent();
                }
            }

            if ((empty($onlinecheck) || ($onlinecheck != "online")) && is_array($Users)) {
                $fb_query = mysql_query("select * from user_fb where userid = ".$new['userid'], $connection) or die(mysql_error());
                if (mysql_num_rows($fb_query) > 0) {
                    $fbRow = mysql_fetch_assoc($fb_query);
                    $fb_username = $fbRow['fb_username'];
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
    private function studentFromQuickRegistrationAskingAQuestion() {
        return !empty($_SESSION['dash_hidden']);
    }

    private function loggedStudentAsksAQuestion() {
        return !empty($_POST['dash_hidden']);
    }
}
