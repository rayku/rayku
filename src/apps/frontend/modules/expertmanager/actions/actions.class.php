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
        return $this->renderText("close");
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
                StatsD::increment("whiteboard.started");
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
        StatsD::increment("whiteboard.create");
    }

    public function executeConnectagain()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $userId = $this->getUser()->getRaykuUser()->getId();
        /* Notify same tutor again */
        // fetch all questions asked by this user in order of most recent asked
        $query = mysql_query("select * from student_questions where user_id = '".$userId."' ORDER BY time DESC", $connection) or die(mysql_error());
        // Query based on the user and the most recent time stamp
        $result = mysql_fetch_array($query);
        $query2 = mysql_query("select * from student_questions where user_id = '".$userId."' AND time = '".$result['time']."'",$connection) or die(mysql_error()); 
        while ($record = mysql_fetch_array($query2)) {
            $switchdata = "INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, course_id, `question`, `exe_order`, `time`,course_code, year, school, status, close) VALUES ('".$record['user_id']."', '".$record['checked_id']."', ".$record['category_id'].", ".$record['course_id'].",'".$record['question']."','".$record['exe_order']."', '".time()."', '".$record['course_code']."', '".$record['year']."', '".$record['school']."', '".$record['status']."', '".$record['close']."')";
            mysql_query($switchdata, $connection) or die("Error In Insert-->".mysql_error());
        }

        setcookie("asker_que",$_COOKIE["asker_que"], time()+600, "/", sfConfig::get('app_cookies_domain'));
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

    public function executeNexttutor() {
        // doing some connecting
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $user_id = $currentUser->getId();

        // this is from the client side
        $tutor_id = $_REQUEST['currenttutor'];

        // get the time, so we know it's the same question
        $result = mysql_query("SELECT * FROM user_expert WHERE user_id = '". mysql_real_escape_string($user_id) ."' AND checked_id = '". mysql_real_escape_string($tutor_id) ."' LIMIT 0,1");
        $queue_item = mysql_fetch_assoc($result);
        $queue_time = $queue_item['time'];

        // delete the current queue item
        mysql_query("DELETE FROM user_expert WHERE user_id = '". mysql_real_escape_string($user_id) ."' AND checked_id = '". mysql_real_escape_string($tutor_id) ."' LIMIT 1");
        print ("rows deleted:" . mysql_affected_rows() . "\n");

        // update the next queue item to have priority 1
        // not sure if it's important, but we should do it anyway
        // only update exec order if something is deleted
        if (mysql_affected_rows() > 0) {
            mysql_query("UPDATE user_expert SET exe_order='1' WHERE user_id = '". mysql_real_escape_string($user_id) ."' AND time = '". mysql_real_escape_string($queue_time) ."' LIMIT 1");
            print ("rows updated:" . mysql_affected_rows() . "\n");            
        }

        exit;
    }


    public function executeCurrenttutor() {
        // connect to the database and get the current user's id
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();

        // make a query to the user_expert table (which should hold current questions)
        // sort by status, lowest first, and limit to one
        $sql = "SELECT * FROM user_expert WHERE user_id='". mysql_real_escape_string($userId) ."' ORDER BY exe_order LIMIT 0,1";
        $result = mysql_query($sql);

        // if there is nothing else, let sami know by returning a blank object
        if (mysql_num_rows($result) === 0) {
            print "";
            exit;
        }

        // get the target tutor's id, and get their information
        $tutor_row = mysql_fetch_assoc($result);
        $tutor_id = $tutor_row['checked_id'];

        // get their username, firt, and last name
        $sql = "SELECT * FROM user WHERE id='". mysql_real_escape_string($tutor_id) ."'";
        $result = mysql_query($sql);
        $tutor_info = mysql_fetch_assoc($result);
        $tutor_user_name = $tutor_info['username']; 
        $tutor_full_name = $tutor_info['name']; 
        $tutor_pic_url = 'http://'. RaykuCommon::getCurrentHttpDomain() . "/avatar/$tutor_id/0";


        // get their experience and profile
        $sql = "SELECT * FROM tutor_profile WHERE user_id='". mysql_real_escape_string($tutor_id) ."'";
        $result = mysql_query($sql);
        $tutor_info = mysql_fetch_assoc($result);
        $tutor_school = $tutor_info['school']; 
        $tutor_role = $tutor_info['tutor_role']; 
        $tutor_study = $tutor_info['study']; 


        // get an object ready to return to client end
        $return_obj = new stdClass;
        $return_obj->id = $tutor_id;
        $return_obj->user_name = $tutor_user_name;
        $return_obj->full_name = $tutor_full_name;
        $return_obj->pic_url = $tutor_pic_url;
        $return_obj->school = $tutor_school;
        $return_obj->role = $tutor_role;
        $return_obj->study = $tutor_study;

        // return json-encoded object
        print json_encode($return_obj);
        exit;
    }

}