<?php

/**
 * dashboard actions.
 *
 * @package    elifes
 * @subpackage dashboard
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */

class dashboardActions extends sfActions
{
    /**
     * Executes index action
     */
    public function executeIndex()
    {
        unset($_SESSION['dash_hidden']);
        unset($_SESSION['subject']);
        unset($_SESSION['edu']);
        unset($_SESSION['course_id']);
        unset($_SESSION['name']);
        unset($_SESSION["asker_school"]);
        unset($_SESSION['course_code']);
        unset($_SESSION["asker_cc_id"]);
        unset($_SESSION['year']);
        unset($_SESSION['asker_year']);
        unset($_SESSION['grade']);
        unset($_SESSION['question']);

        if (!empty($_COOKIE["timer"])) {
            $this->redirect('/dashboard/rating');
        }

        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        $this->logedUserId =  $logedUserId;
        $query = mysql_query("select * from user where id=".$logedUserId." ", $connection) or die(mysql_error());
        $row = mysql_fetch_assoc($query);

        $c = new Criteria();
        $rankexperts = ExpertCategoryPeer::doSelect($c);
        $rankUsers = array(); $ji =0; $newUserLimit = array();
        foreach($rankexperts as $exp){
            if (!in_array($exp->getUserId(), $newUserLimit)) {
                $newUserLimit[] = $exp->getUserId();
                $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ", $connection) or die(mysql_error());
                if (mysql_num_rows($_query) > 0) {
                    $query = mysql_query("select * from user_score where user_id=".$exp->getUserId(), $connection) or die(mysql_error());
                    $score = mysql_fetch_assoc($query);
                    if ($score['score'] != 0){
                        $dv=new Criteria();
                        $dv->add(UserPeer::ID,$exp->getUserId());
                        $_thisUser = UserPeer::doSelectOne($dv);
                        $rankUsers[$ji] = array("score" => $score['score'], "userid" => $exp->getUserId(), "createdat" => $_thisUser->getCreatedAt());
                        $ji++;
                    }
                }
            }
        }
        asort($rankUsers);
        arsort($rankUsers);
        $this->rankUsers = $rankUsers;
        $this->getResponse()->setCookie("practice_name", $row['username'],time()+3600);
        $queryScore = mysql_query("select * from user_score where user_id =".$logedUserId." and score >= 125 and status = 0", $connection) or die(mysql_error());
        $this->changeUserType = null;
        if (mysql_num_rows($queryScore) > 0) {
            $this->changeUserType = 1;
        }
    }

    public function executeTag()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        mysql_query("delete from user_question_tag where id=".$_REQUEST['id'][1], $connection);
        $userId = $this->getUser()->getRaykuUser()->getId();
        $countquery = mysql_query("select user_id from `user_question_tag` where user_id = ".$userId, $connection);
        echo $countrows = mysql_num_rows($countquery);
        exit(0);
    }

    public function executeAutocomplete()
    {
    }

    public function executeAutocourse()
    {
    }

    public function executeAskquestionqueries()
    {
    }

    function cmp($a, $b)
    {
        if ($a["score"] == $b["score"]) {
            return strcmp($a["createdat"], $b["createdat"]);
        }
        return ($a["score"] < $b["score"]) ? 1 : -1;
    }

    public function executeVerifytutor() {
        $connection = RaykuCommon::getDatabaseConnection();
        $_userId = $this->getUser()->getRaykuUser()->getId();
        $queryScore = mysql_query("select * from user_score where user_id =".$_userId."", $connection) or die(mysql_error());
        if (mysql_num_rows($queryScore) > 0) {
            mysql_query("update user_score set status = 1 where user_id =".$_userId."", $connection) or die(mysql_error());
        }
        $this->redirect('/dashboard');
    }

    public function executeTutorprofile()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        if ($_POST['usrid']) {
            $uid = $_POST['usrid'];
            $catid = $_POST['category'];
            $courseid = $_POST['catcheck'];
            $usrdesc = $_POST['description'];
            $school = $_POST['school'];
            $study = $_POST['study'];
            $coursecode = $_POST['CourseCodes'];

            if ($usrdesc=='Freshman') {
                $year = '1st Year';
            } else if ($usrdesc=='Sophomore') {
                $year = '2nd Year';
            } else if ($usrdesc=='Junior') {
                $year = '3rd Year';
            } else if ($usrdesc=='Senior') {
                $year = '4th Year';
            } else {
                $year = '4+ Year';
            }

            $courses = implode("-",$courseid);
            $_select = mysql_query("select * from tutor_profile where user_id=".$uid, $connection) or die(mysql_error());
            if (mysql_num_rows($_select) > 0) {
                mysql_query("update tutor_profile set category = '".$catid."',course_id = '".$courses."', school = '".$school."', year = '".$year."', tutor_role = '".$usrdesc."', study = '".$study."', course_code = '".$coursecode."' where user_id=".$uid, $connection) or die(mysql_error());
            } else {
                mysql_query("insert into tutor_profile(user_id,category,course_id,school,year,tutor_role,study,course_code) values('".$uid."','".$catid."','".$courses."','".$school."','".$year."','".$usrdesc."','".$study."','".$coursecode."')", $connection) or die(mysql_error());
            }
            $this->redirect('/dashboard');
        }
    }

    public function executeTutor()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $_userId = $this->getUser()->getRaykuUser()->getId();
        $_select = mysql_query("select * from user_tutor where userid=".$_userId, $connection) or die(mysql_error());
        if (mysql_num_rows($_select) > 0) {
            mysql_query("delete from user_tutor where userid = ".$_userId." ", $connection) or die(mysql_error());
            $_query = mysql_query("update user_rate set rate = 0.00 where userid=".$_userId, $connection) or die(mysql_error());
            if (!$_query) {
                mysql_query("insert into user_rate(userid,rate) values(".$_userId.", '0.00') ", $connection) or die(mysql_error());
            }

            $insSQL = "INSERT INTO `log_user_on_off` (
                `id` ,
                `user_id` ,
                `off_date_time` ,
                `off_status`
            )
            VALUES (
                NULL ,
                '".$_userId."',
                '".date("Y-m-d H:i:s")."',
                '0'
            );";
            mysql_query($insSQL, $connection);

            $this->redirect('/dashboard');
        } else {
            if ($_POST['usrid']) {
                $uid = $_POST['usrid'];
                $catid = $_POST['category'];
                $courseid = $_POST['catcheck'];
                $usrdesc = $_POST['description'];
                $school = $_POST['school'];
                $study = $_POST['study'];
                $coursecode = $_POST['CourseCodes'];

                $courses = implode("-",$courseid);

                if ($usrdesc=='Freshman') {
                    $year = '1st Year';
                } else if ($usrdesc=='Sophomore') {
                    $year = '2nd Year';
                } else if ($usrdesc=='Junior') {
                    $year = '3rd Year';
                } else if ($usrdesc=='Senior') {
                    $year = '4th Year';
                } else {
                    $year = '4+ Year';
                }

                // change  Tutor on / off status //
                $insSQL = "INSERT INTO `log_user_on_off` (
                    `id` ,
                    `user_id` ,
                    `off_date_time` ,
                    `off_status`
                )
                VALUES (
                    NULL ,
                    '".$uid."',
                    '".date("Y-m-d H:i:s")."',
                    '1'
                );";
                mysql_query($insSQL, $connection);

                $_select = mysql_query("select * from tutor_profile where user_id=".$uid, $connection) or die(mysql_error());
                if (mysql_num_rows($_select) > 0) {
                    mysql_query("update tutor_profile set category = '".$catid."',course_id = '".$courses."', school = '".$school."', year = '".$year."', tutor_role = '".$usrdesc."', study = '".$study."', course_code = '".$coursecode."' where user_id=".$uid, $connection) or die(mysql_error());
                } else {
                    mysql_query("insert into tutor_profile(user_id,category,course_id,school,year,tutor_role,study,course_code) values('".$uid."','".$catid."','".$courses."','".$school."','".$year."','".$usrdesc."','".$study."','".$coursecode."')", $connection) or die(mysql_error());
                }

                mysql_query("insert into user_tutor(userid) values(".$_userId.")", $connection) or die(mysql_error());
                $_query = mysql_query("update user_rate set rate = 0.00 where userid=".$_userId, $connection) or die(mysql_error());
                if (!$_query) {
                    mysql_query("insert into user_rate(userid,rate) values(".$_userId.", '0.00') ", $connection) or die(mysql_error());
                }

                $this->redirect('/tutorshelp');
            }
        }
    }

    public function executeNew()
    {
        $this->user  = $this->getUser()->getRaykuUser();
    }

    public function executeGetstarted()
    {
        $this->user = $this->getUser()->getRaykuUser();
    }

    public function executeProcessprofile()
    {
        $this->user = $this->getUser()->getRaykuUser();
    }

    public function executePointserror()
    {
    }

    public function executeExpire()
    {
    }

    public function executeMoneystore()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $userId = $this->getUser()->getRaykuUser()->getId();
        if ($_POST['reason'] == "Reason For Asking Money Back..." || empty($_POST['reason']))  {
            $_SESSION['reason'] = 1;
        } elseif (!empty($_POST['reason'])) {
            if (!empty($_SESSION["whiteboard_Chat_Id"])) {
                mysql_query("insert into whiteboard_moneyback(chat_id, reason) values(".$_SESSION["whiteboard_Chat_Id"].", '".$_POST['reason']."')", $connection) or die(mysql_error());
                $this->redirect('/dashboard/moneyredirect');
            }
        }
        $this->redirect('/dashboard/moneyback');
    }

    public function executeMoneyback()
    {
    }

    public function executeMoneyredirect()
    {
    }

    public function executeFacebook()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $userId = $this->getUser()->getRaykuUser()->getId();
        if (@$_POST['_hidden_facebook'] && !empty($_POST['fbname'])) {
            $fb_username = $_POST['fbname'];
            $this->redirect('http://www.facebook.com/dialog/friends/?id=raykubot&app_id=304330886250108&redirect_uri=http://'.RaykuCommon::getCurrentHttpDomain().'/dashboard/facebookadd?username='.$fb_username);
        }
        $query = mysql_query("select * from user_fb where userid =".$userId." ", $connection) or die(mysql_error());
        if (mysql_num_rows($query) > 0) {
            $this->record = 1;
            $row = mysql_fetch_assoc($query);
            $this->facebook = $row['fb_username'];
        } else {
            $this->record = 0;
        }
    }

    public function executeFacebookadd()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $userId = $this->getUser()->getRaykuUser()->getId();
        $query = mysql_query("select * from user_fb where userid =".$userId." ", $connection) or die(mysql_error());
        $fb_username = !empty($_GET['username']) ? $_GET['username'] : '';
        if (!empty($fb_username)) {
            $this->display = 1;
            if (mysql_num_rows($query) > 0) {
                mysql_query("update user_fb set fb_username = '".$fb_username."' where userid = ".$userId." ", $connection) or die(mysql_error());
            } else {
                mysql_query("insert into user_fb(userid, fb_username) values(".$userId.", '".$fb_username."' ) ", $connection) or die(mysql_error());
            }
        } else {
            $this->display = 2;
        }
        BotServiceProvider::createFor("http://facebook.rayku.com/bot_enabled?action=1")->getContent();
    }

    public function executeGtalk()
    {
        /* @var $user User */
        $user = $this->getUser()->getRaykuUser();
        $userGtalk = $user->getUserGtalk();
        if ($userGtalk) {
            $this->record = 1;
            $this->gtalk = $userGtalk->getGtalkId();
        } else {
            $this->record = 0;
        }
    }

    public function executeGtalkupdate($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();

        /* @var $user User */
        $user = $this->getUser()->getRaykuUser();
        $userGtalk = $user->getUserGtalk();

        if (!$userGtalk) {
            $userGtalk = new UserGtalk;
            $userGtalk->setUser($user);
        }

        $email = $request->getParameter('gtalkname');
        $checkemail = explode("@", $email);
        if (count($checkemail) == 1) {
            $email .= '@gmail.com';
        }

        $test = BotServiceProvider::createFor('http://www.rayku.com:8892/add/'.$email)->getContent();

        if ($test) {
            $_SESSION['adduser'] = 1;
        } else {
            $_SESSION['adduser'] = 2;
            $this->redirect('/dashboard/gtalk');
        }

        $userGtalk->setGtalkid($email);
        $userGtalk->save();

        $this->redirect('/dashboard/gtalk');
    }

    public function executeBeforeclose()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $this->getUser()->getRaykuUser()->getId();
        mysql_query("delete from popup_close where user_id=".$logedUserId, $connection) or die(mysql_error());
    }

    public function executeThank()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $this->getUser()->getRaykuUser()->getId();
        $cookiename= $logedUserId."_question";
        $limitcookiename = $logedUserId."_limit";

        if (!empty($_COOKIE["whiteboardChatId"]) && !empty($_POST['audio']) &&  !empty($_COOKIE["ratingExpertId"])) {
            $wtf = new WhiteboardTutorFeedback;
            $wtf->setWhiteboardChatId($_COOKIE["whiteboardChatId"]);
            $wtf->setExpertId($_COOKIE["ratingExpertId"]);
            $wtf->setAudio(!empty($_POST["audio"]) ? $_POST["audio"] : '');
            $wtf->setUsability(!empty($_POST["use"]) ? $_POST["use"] : '');
            $wtf->setOverall(!empty($_POST["overall"]) ? $_POST["overall"] : '');
            $wtf->setFeedback(!empty($_POST["feedback"]) ? $_POST["feedback"] : '');
            $wtf->setCreatedAt(date("Y-m-d H:i:s"));
            $wtf->save();
        }

        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);

                if (($name != $cookiename) && ($name != $limitcookiename) && ($name != "WRUID") && ($name != "rayku_frontend") && ($name != "practice_name")  ) {
                    $this->getResponse()->setCookie($name, "", time()-3600);
                }
            }
        }
    }

    public function executeChargerate()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $_Rate = !empty($_GET['rate']) ? $_GET['rate'] : '0.00';
        $userId = $this->getUser()->getRaykuUser()->getId();
        $query = mysql_query("select * from user_rate where userid=".$userId, $connection) or die(mysql_error());
        if (mysql_num_rows($query) > 0) {
            mysql_query("update user_rate set rate = ".$_Rate." where userid=".$userId, $connection) or die(mysql_error());
        } else {
            mysql_query("insert into user_rate(userid,rate) values(".$userId.", ".$_Rate.") ", $connection) or die(mysql_error());
        }
        return sfView::HEADER_ONLY;
    }

    public function executeStay()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $userId = $this->getUser()->getRaykuUser()->getId();
        $user = $this->getUser()->getRaykuUser();
        $time = time() - 1800;
        $query = mysql_query("select * from user_stay where user_id=".$userId." ", $connection) or die(mysql_error());
        if ((mysql_num_rows($query) > 0) && ($user->isOnline())) {
            $queryStay = mysql_query("select * from user_stay where user_id=".$userId." and time <= '".$time."' ", $connection) or die(mysql_error());
            if (mysql_num_rows($queryStay) > 0) {
                $_time = time();
                $_rowStay = mysql_fetch_assoc($queryStay);
                $stayTime = $_rowStay['stay'] + 1;
                mysql_query("update user_stay set stay = '".$stayTime."', time = '".$_time."' where user_id=".$userId, $connection) or die(mysql_error());
            }
        } elseif ($user->isOnline()) {
            $_time = time();
            mysql_query("insert into user_stay(user_id,time, stay) values(".$userId.",'".$_time."', 1) ", $connection) or die(mysql_error());
        }
        exit(0);
    }
}
