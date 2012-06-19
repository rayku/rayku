<?php
/**
 * expertmanager actions.
 */
class expertmanagerActions extends sfActions
{

    public function executeTransfer() { }

    public function executeTutorial() { }

    public function executeDirect()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $time = time();
        mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`,`course_id`, `question`, `exe_order`, `time`, `status`) VALUES ('".$userId."', '".$_GET['id']."', '1', '1',  'To be discussed', 1, '".$time."', 1) ", $connection) or die(mysql_error());

        $l = 0;
        $source = 'tutor';
        mysql_query("DELETE FROM `student_questions` WHERE user_id = ".$userId."", $connection);
        mysql_query("INSERT INTO `student_questions` (`user_id`, `checked_id`, `category_id`,`course_id`, `question`, `exe_order`, `time`, `status`, source) VALUES ('".$userId."', '".$_GET['id']."', '1', '1',  'To be discussed', 1, '".$time."', 1, '".$source."') ", $connection) or die(mysql_error());
        setcookie("asker_que",'To be discussed', time()+600, "/", sfConfig::get('app_cookies_domain'));
        $this->getResponse()->setCookie("redirection", 1,time()+600, '/', sfConfig::get('app_cookies_domain'));
        $this->getResponse()->setCookie("forumsub", 5,time()+600, '/', sfConfig::get('app_cookies_domain'));
        $this->redirect('/expertmanager/connect');
    }

    public function executeStatus()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $_status_id = $_GET['id'];
        $_queryStatus = mysql_query("select * from user_expert where id = ".$_status_id." ", $connection) or die(mysql_error());
        if (mysql_num_rows($_queryStatus)) {
            mysql_query("update user_expert set status = 0 where id = ".$_status_id." ", $connection) or die(mysql_error());
            echo "status updated";
        }
        $this->redirect('/dashboard');
    }

    public function executeWhiteboard() { }

    public function executeClose()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();

        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        mysql_query("insert into popup_close(user_id) values(".$userId.")", $connection) or die(mysql_error());
        $this->redirect('/dashboard');
    }

    public function executeCookieadd()
    {
        $userId = $this->getUser()->getRaykuUser()->getId();
        $userName = $this->getUser()->getRaykuUser()->getUsername();
        $connection = RaykuCommon::getDatabaseConnection();
        mysql_query("delete from user_question where user_id = ".$userId, $connection) or die(mysql_error());
        mysql_query("delete from missed_question_info where send_user = '".$userName."'", $connection) or die(mysql_error());
        if ($_GET['cookie'] == 0) {
            $this->getResponse()->setCookie("popup_close", '', time()-300, '/', sfConfig::get('app_cookies_domain'));
        } else {
            if (empty($_COOKIE['popup_close'])) {
                $this->getResponse()->setCookie("popup_close", $_GET['cookie'], time()+300, '/', sfConfig::get('app_cookies_domain'));
            }
        }

        $this->redirect('/dashboard');
    }

    public function executeTopic()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();

        $_query = mysql_query("select * from user_question where status = 1 and user_id = ".$userId, $connection) or die(mysql_error());

        if (mysql_num_rows($_query) > 0) {
            $sel_misqry = mysql_query("SELECT * FROM missed_question_info WHERE send_user = '".$currentUser->getUsername()."' ORDER BY question_id DESC", $connection);
            $misqry = mysql_fetch_array($sel_misqry);
            $misscont = '<div id = "popup_data" align = "left">
                <h2 style = "font-size:18px;color:#333333;font-weight:normal;padding:20px 0 10px 0">'.$misqry['question'].'</h2>
                <p style = "font-size:14px;line-height:20px;color:#555;margin:0;"><strong>Subject:</strong> '.$misqry['course'].'</p>';
            if ($misqry['category']) {
                $misscat = '<p style = "font-size:14px;line-height:20px;color:#555;margin:0;"><strong>Course Code:</strong> '.$misqry['category'].'</p>';
            }
            $missmsg = '<p style = "font-size:14px;line-height:20px;color:#555;margin:0;"><strong>Student:</strong> '.$misqry['ask_user'].' (<a href = "../../message/compose/'.$misqry['ask_user'].'" style = "color:#006699">message</a>)</p>';

            if ($misqry['year']) {
                $missyr = '<p style = "font-size:14px;line-height:20px;color:#555;margin:0;">Year '.$misqry['year'].' ';
            }

            if ($misqry['school']) {
                $misssch = $misqry['school'].'</p></div>';
            }
            echo 'yes~'.$misscont.@$misscat.$missmsg.@$missyr.@$misssch;
        } else {
            echo "no";
        }
        exit(0);
    }


    public function executeIgnore()
    {

        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();

        $userId = $currentUser->getId();
        $_SESSION["_modelbox"] = 0;
        @setcookie('_popupclose', '', time()-300, '/', sfConfig::get('app_cookies_domain'));
        if (@$_SESSION['modelPopupOpen']) {
            unset($_SESSION['modelPopupOpen']);
            if ($_SESSION['popup_session']) {
                unset($_SESSION['popup_session']);
            }
        }

        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        $details =  explode(",", $_REQUEST['details']);
        if (count($details) > 2 ) {
            $newId = $details[6] + 1;
            $query = mysql_query("select * from user_expert where id = ".$newId." and user_id = ".$details[1], $connection) or die(mysql_error());
            if (mysql_num_rows($query) > 0) {
                mysql_query("update user_expert set exe_order = 1 where id = ".$newId, $connection) or die(mysql_error());
            }

            mysql_query("delete from user_expert where id = ".$details[6], $connection) or die(mysql_error());
            /* Expert Socre - Reduction */
            $queryScore = mysql_query("select * from user_score where user_id = ".$userId, $connection) or die(mysql_error());
            if (mysql_num_rows($queryScore) > 0) {

                $rowScore = mysql_fetch_assoc($queryScore);

                $checkRatingScore = $rowScore['score'] - 3;

                if ($checkRatingScore < 1) {
                    $newRatingScore = '1';
                } else {
                    $newRatingScore = $rowScore['score'] - 3;
                }
                mysql_query("update user_score set score = ".$newRatingScore." where user_id = ".$userId, $connection) or die(mysql_error());
            }
        } else {
            mysql_query("delete from sendmessage where id = ".$_REQUEST['details'], $connection) or die(mysql_error());
        }
        echo "close";
    }

    public function executeAuto()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();

        $userId = $currentUser->getId();

        $_SESSION["_modelbox"] = 0;

        @setcookie('_popupclose', '', time()-300, '/', sfConfig::get('app_cookies_domain'));

        if ($_SESSION['modelPopupOpen']) {
            unset($_SESSION['modelPopupOpen']);
            if ($_SESSION['popup_session']) {
                unset($_SESSION['popup_session']);
            }
        }

        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

        $details =  explode(",", $_REQUEST['details']);
        if (count($details) > 2 ) {
            $newId = $details[6] + 1;
            $queryCheck = mysql_query("select * from user_expert where id = ".$details[6]." ", $connection) or die(mysql_error());
            if (mysql_num_rows($queryCheck) > 0) {
                $query = mysql_query("select * from user_expert where id = ".$newId." and user_id = ".$details[1], $connection) or die(mysql_error());
                if (mysql_num_rows($query) > 0) {
                    mysql_query("update user_expert set exe_order = 1 where id = ".$newId, $connection) or die(mysql_error());
                }
                //Set Session for Missed Question Popup
                $usr_miss_query = mysql_query("select * from user_expert as u join courses as c on u.course_id = c.id where u.id = ".$details[6]."", $connection) or die(mysql_error());
                $miss_qry = mysql_fetch_array($usr_miss_query);

                $senderId = mysql_fetch_array($queryCheck);
                $sender = $senderId['checked_id'];
                $asker = $senderId['user_id'];

                $c = new Criteria();
                $c->add(UserPeer::ID,$asker);
                $_User = UserPeer::doSelectOne($c);
                $username = $_User->getUsername();
                $c = new Criteria();
                $c->add(UserPeer::ID,$sender);
                $_Expert = UserPeer::doSelectOne($c);
                $sendername = $_Expert->getUsername();

                $coursename = $miss_qry['course_name'];
                $course_code = $miss_qry['course_code'];
                $year = $miss_qry['year'];
                $school = $miss_qry['school'];
                $category = $miss_qry['category_id'];
                $question = $miss_qry['question'];
                $currtime = date('Y-m-d H:i:s');

                mysql_query("INSERT INTO missed_question_info (send_user, ask_user, question, category, course, year, school, asked_time) VALUES('$sendername','$username', '$question', '$course_code', '$coursename', '$year', '$school', '$currtime' ) ", $connection) or die(mysql_error());

                mysql_query("delete from user_expert where id = ".$details[6], $connection) or die(mysql_error());
                /* Expert Socre - Reduction */
                $queryScore = mysql_query("select * from user_score where user_id = ".$userId, $connection) or die(mysql_error());

                if (mysql_num_rows($queryScore) > 0) {
                    $rowScore = mysql_fetch_assoc($queryScore);
                    $checkRatingScore = $rowScore['score'] - 3;
                    if ($checkRatingScore < 1) {
                        $newRatingScore = '1';
                    } else {
                        $newRatingScore = $rowScore['score'] - 3;
                    }
                    mysql_query("update user_score set score = ".$newRatingScore." where user_id = ".$userId, $connection) or die(mysql_error());
                }
                $time = time();

                mysql_query("insert into user_question(user_id, status, time) values(".$details[0].", 1,'".$time."')", $connection);
            }
        } else {
            mysql_query("delete from sendmessage where id = ".$_REQUEST['details'], $connection) or die(mysql_error());
        }
        echo "close";
    }

    public function executeCookie()
    {
        $this->getResponse()->setCookie("_post_id", $_GET['id'],time()+300, '/', sfConfig::get('app_cookies_domain'));
        echo "cookie set";
    }

    public function executeRedirect()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $query = mysql_query("select * from user_expert where user_id = ".$userId, $connection) or die(mysql_error());
        if (mysql_num_rows($query) == 0) {
            if (empty($_COOKIE["newredirect"]) && $_COOKIE["newredirect"] != 1) {
                $redirectvalue = "redirect";
            }
            echo $redirectvalue;
        }
        $this->redirect('/dashboard');
    }

    public function executeMapmsguser()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        if (@$_SESSION['modelPopupOpen']) {
            if ($_SESSION['popup_session']) {
                $_now = time();
                $_remain_time = $_now - $_SESSION['popup_session'];
                if ($_remain_time < 20) {
                    return $this->renderText('redirect');
                }
            } else {
                    return $this->renderText('redirect');
            }
        }
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $time = time()-300;
        if (!empty($_COOKIE['redirection']) && $_COOKIE['redirection'] == 1) {
            $query = mysql_query("select * from sendmessage where asker_id = ".$userId." and time >= ".$time."", $connection) or die(mysql_error());
            if (mysql_num_rows($query) > 0) {
                $_SESSION['modelPopupOpen'] = 1;
                $_SESSION['popup_session'] = time();
                $row = mysql_fetch_array($query);
                echo "msg-".$row['id']."-".$row['expert_id']."-".$row['asker_id']."-".$row['chat_id'];
                StatsD::increment("whiteboard.session.questionAccepted");
            }
        }
        exit(0);
    }

    public function executeCheckbox() {
        $_id = explode("checkbox[", $_GET['id']);
        $_finalId = explode("]", $_id[1]);
        if ($_GET['type'] == "add") {
            $_SESSION['page_tutors'][] = $_finalId[0];
        } else {
            foreach ($_SESSION['page_tutors'] as $key => $value) {
                if ($_finalId[0] == $value) {
                    unset($_SESSION['page_tutors'][$key]);
                }
            }
        }
        exit(0);
    }

    public function executeCheckoutpopup()
    {
        $connection = RaykuCommon::getDatabaseConnection();
    }

    public function executeMissqryreload()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $this->raykuUser = $this->getUser()->getRaykuUser();
    }

    public function executeConnect()
    {
        StatsD::increment("whiteboard.session.create");
    }

    public function executeConnectagain()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $userId = $this->getUser()->getRaykuUser()->getId();
        /* Notify same tutor again */
        $query = mysql_query("select * from student_questions where user_id = '".$userId."'", $connection) or die(mysql_error());
        while ($record = mysql_fetch_array($query)) {
            $switchdata = "INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, course_id, `question`, `exe_order`, `time`,course_code, year, school, status, close) VALUES ('".$record['user_id']."', '".$record['checked_id']."', ".$record['category_id'].", ".$record['course_id'].",'".$record['question']."','".$record['exe_order']."', '".$record['time']."', '".$record['course_code']."', '".$record['year']."', '".$record['school']."', '".$record['status']."', '".$record['close']."')";
            mysql_query($switchdata, $connection) or die("Error In Insert-->".mysql_error());
        }

        setcookie("asker_que",'To be discussed', time()+600, "/", sfConfig::get('app_cookies_domain'));
        $this->getResponse()->setCookie("redirection", 1,time()+600, '/', sfConfig::get('app_cookies_domain'));
        $this->getResponse()->setCookie("forumsub", 1,time()+600, '/', sfConfig::get('app_cookies_domain'));
        return $this->redirect('expertmanager/connect');
    }

    public function executeStudentconfirmation()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $this->userid = $this->getUser()->getRaykuUser()->getId();
    }

    public function executeExpertsreject() { }

    public function executeModify() { }

}