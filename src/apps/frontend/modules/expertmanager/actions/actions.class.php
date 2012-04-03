<?php
/**
 * expertmanager actions.
 */
class expertmanagerActions extends sfActions
{
    /**
     * Executes index action
     */
    public function executeIndex()
    {
        if (!empty($_COOKIE["timer"])) {
            $this->redirect('/dashboard/rating');
        }
        $this->expert = UserPeer::retrieveByPk($this->getUser()->getRaykuUserId());

        $c = new Criteria();
        $c->add(ExpertCategoryPeer::USER_ID, $this->getUser()->getRaykuUserId());
        $this->expert_categories = ExpertCategoryPeer::doSelect($c);
        $this->questions = ForumQuestionPeer::doSelect(new Criteria());

        $c = new Criteria();
        $c->add(ExpertPeer::USER_ID, $this->getUser()->getRaykuUserId());
        $this->expert_info = ExpertPeer::doSelectOne($c);

        $c = new Criteria();
        $c->add(ExpertLessonPeer::USER_ID,$this->getUser()->getRaykuUserId());
        $this->lessons = ExpertLessonPeer::doSelect($c);

        $c = new Criteria();
        $c->add(ExpertsImmediateLessonPeer::USER_ID,$this->getUser()->getRaykuUserId());
        $this->immlessons = ExpertsImmediateLessonPeer::doSelect($c);

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::USER_ID,$this->getUser()->getRaykuUserId());
        $this->monthschedules = ExpertLessonSchedulePeer::doSelect($c);

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::USER_ID,$this->getUser()->getRaykuUserId());
        $this->lessondates = ExpertLessonSchedulePeer::doSelect($c);

        $c = new Criteria();
        $c->add(ExpertAvailableDaysPeer::EXPERT_ID,$this->getUser()->getRaykuUserId());
        $this->lessondays = ExpertAvailableDaysPeer::doSelect($c);

        $c = new Criteria();
        $c->addJoin(ThreadPeer::CATEGORY_ID,ExpertCategoryPeer::CATEGORY_ID,Criteria::JOIN);
        $c->add(ExpertCategoryPeer::USER_ID,$this->getUser()->getRaykuUserId());
        $c->addDescendingOrderByColumn('ID');
        $this->questions = ThreadPeer::doSelect($c);
    }

    public function executePortfolio()
    {
        if (!empty($_COOKIE["timer"])) {
            $this->redirect('/dashboard/rating');
        }
        $connection = RaykuCommon::getDatabaseConnection();
        $name = explode("/", $_SERVER['REQUEST_URI']);

        $query = mysql_query("select * from user where username = '".$name[3]."' ", $connection) or die(mysql_error());
        $row = mysql_fetch_array($query);

        $this->expert = UserPeer::retrieveByPk($row['id']);

        $expertId = $row['id'];
        $userId = $this->getUser()->getRaykuUserId();

        // last n whiteboard sessions
        $cLastSessions = new Criteria();

        if ($userId != $expertId) {
            $cPublicA = $cLastSessions->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $expertId);
            $cPublicB = $cLastSessions->getNewCriterion(WhiteboardChatPeer::IS_PUBLIC, true);
            $cPublicC = $cLastSessions->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
            $cPublicB->addOr($cPublicC);
            $cPublicA->addAnd($cPublicB);
        } else {
            $cPublicA = $cLastSessions->getNewCriterion(WhiteboardChatPeer::EXPERT_ID, $userId);
            $cPublicB = $cLastSessions->getNewCriterion(WhiteboardChatPeer::ASKER_ID, $userId);
            $cPublicA->addOr($cPublicB);
        }

        $cLastSessions->add($cPublicA);
        $cLastSessions->add(WhiteboardChatPeer::STARTED_AT, null, Criteria::ISNOTNULL);
        $cLastSessions->addDescendingOrderByColumn(WhiteboardChatPeer::ID);
        $cLastSessions->setLimit(3);
        $this->lastSessions = WhiteboardChatPeer::doSelect($cLastSessions);
    }

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
        setcookie("asker_que",'To be discussed', time()+600, "/");
        $this->getResponse()->setCookie("redirection", 1,time()+600);
        $this->getResponse()->setCookie("forumsub", 5,time()+600);
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

    public function executeCheckout()
    {
        $this->expert_id = $this->getRequestParameter('expert_id');
        $this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id');

        $date = mktime(0,0,0,date('m'),date('d'),date('Y'));

        $c= new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->expert_lesson_id);
        $this->expert_lesson = ExpertLessonPeer::doSelectOne($c);

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::USER_ID,$this->expert_id);
        $c->add(ExpertLessonSchedulePeer::DATE,$date,Criteria::GREATER_EQUAL);
        $c->addAscendingOrderByColumn(ExpertLessonSchedulePeer::DATE);
        $this->lesson_shedules = ExpertLessonSchedulePeer::doSelect($c);


        $c = new Criteria();
        $c->add(ExpertAvailableDaysPeer::EXPERT_ID,$this->expert_id);
        $this->lessondays = ExpertAvailableDaysPeer::doSelect($c);
    }

    public function executeImmediate()
    {
        $this->expert_id = $this->getRequestParameter('expert_id');
        $this->expert_immediate_lesson_id = $this->getRequestParameter('expert_immediate_lesson_id');

        $c= new Criteria();
        $c->add(ExpertsImmediateLessonPeer::ID,$this->expert_immediate_lesson_id);
        $this->expert_lesson = ExpertsImmediateLessonPeer::doSelectOne($c);
    }

    public function executeHistory()
    {
        $this->less_id= $this->getRequestParameter('less_id') ;

        $c = new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('less_id'));
        $this->lesson = ExpertLessonPeer::doSelectOne($c);

        $c= new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('less_id'));
        $this->expert_lesson = ExpertLessonPeer::doSelectOne($c);

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getRequestParameter('less_id'));
        $this->lesson_shedules = ExpertLessonSchedulePeer::doSelect($c);
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
            $this->getResponse()->setCookie("popup_close", '', time()-300);
        } else {
            if (empty($_COOKIE['popup_close'])) {
                $this->getResponse()->setCookie("popup_close", $_GET['cookie'], time()+300);
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
        @setcookie('_popupclose', '', time()-300, '/', null);
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

        // Ignore Whiteboard //
        $insSQL = "INSERT INTO `log_user_connect_whiteboard` (
            `id` ,
            `user_id` ,
            `connect_date_time`,
            `connect_status`
        )
        VALUES (
            NULL ,
            '".$logedUserId."',
            '".date("Y-m-d H:i:s")."',
            '0'
        );";
        mysql_query($insSQL, $connection);
        echo "close";
    }

    public function executeAuto()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();

        $userId = $currentUser->getId();

        $_SESSION["_modelbox"] = 0;

        @setcookie('_popupclose', '', time()-300, '/', null);

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
        // Ignore Whiteboard //
        $insSQL = "INSERT INTO `log_user_connect_whiteboard` (
            `id` ,
            `user_id` ,
            `connect_date_time`,
            `connect_status`
        )
        VALUES (
            NULL ,
            '".$logedUserId."',
            '".date("Y-m-d H:i:s")."',
            '0'
        );";
        mysql_query($insSQL, $connection);
        echo "close";
    }

    public function executeCookie()
    {
        $this->getResponse()->setCookie("_post_id", $_GET['id'],time()+300);
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

        setcookie("asker_que",'To be discussed', time()+600, "/");
        $this->getResponse()->setCookie("redirection", 1,time()+600);
        $this->getResponse()->setCookie("forumsub", 1,time()+600);
        return $this->redirect('expertmanager/connect');
    }

    public function executeStudentconfirmation()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $this->userid = $this->getUser()->getRaykuUser()->getId();
    }

    public function executeReschedule()
    {
        $this->less_id= $this->getRequestParameter('less_id') ;

        $c = new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('less_id'));
        $this->lesson = ExpertLessonPeer::doSelectOne($c);

        $c= new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('less_id'));
        $this->expert_lesson = ExpertLessonPeer::doSelectOne($c);

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getRequestParameter('less_id'));
        $this->lesson_shedules = ExpertLessonSchedulePeer::doSelect($c);

        if ($date = $this->getRequestParameter('date')) {
            $c = new Criteria();
            $c->add(ExpertLessonSchedulePeer::DATE, $this->getRequestParameter('date'));
            $c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getRequestParameter('less_id'));
            $check_date = ExpertLessonSchedulePeer::doSelectOne($c);

            // echo count($check_date) ;

            if (count($check_date) > 0) {
                $date = ExpertLessonSchedulePeer::retrieveByPk($check_date->getId());
            } else {
                $date = new ExpertLessonSchedule();
            }

            $timings = implode("|",$this->getRequestParameter('timings'));

            $date->setTimings($timings);
            $date->setDate($this->getRequestParameter('date'));
            $date->setUserId($this->getUser()->getRaykuUserId());
            $date->setExpertLessonId($this->getRequestParameter('less_id'));

            $date->save();
            $lesson = ExpertLessonPeer::retrieveByPk($this->getRequestParameter('less_id'));
            $user = UserPeer::retrieveByPk($this->getUser()->getRaykuUserId());

            $c = new Criteria();
            $c->add(ExpertsLessonMembersPeer::LESSON_ID,$this->getRequestParameter('less_id'));
            $lesson_members = ExpertsLessonMembersPeer::doSelect();
            if ($lesson_members != NULL) {
                $sub1 = 'Lesson'.$lesson->getTitle().' has been rescheduled';
                foreach ($lesson_members as $lesson_member) {
                    $student = UserPeer::retrieveByPk($lesson_member->getStudentId());
                    $expert = UserPeer::retrieveByPk($lesson_member->getExpertId());
                    $times = explode('|',$timings);
                    $time = '';
                    foreach ($times as $timelist) {
                        if ($timelist == '0') { $time.= '00:00:00,' ; }
                        if ($timelist == '1') { $time.= '01:00:00,' ; }
                        if ($timelist == '2') { $time.= '02:00:00,' ; }
                        if ($timelist == '3') { $time.= '03:00:00,' ; }
                        if ($timelist == '4') { $time.= '04:00:00,' ; }
                        if ($timelist == '5') { $time.= '05:00:00,' ; }
                        if ($timelist == '6') { $time.= '06:00:00,' ; }
                        if ($timelist == '7') { $time.= '07:00:00,' ; }
                        if ($timelist == '8') { $time.= '08:00:00,' ; }
                        if ($timelist == '9') { $time.= '09:00:00,' ; }
                        if ($timelist == '10') { $time.= '10:00:00,' ; }
                        if ($timelist == '11') { $time.= '11:00:00,' ; }
                        if ($timelist == '12') { $time.= '12:00:00,' ; }
                        if ($timelist == '13') { $time.= '13:00:00,' ; }
                        if ($timelist == '14') { $time.= '14:00:00,' ; }
                        if ($timelist == '15') { $time.= '15:00:00,' ; }
                        if ($timelist == '16') { $time.= '16:00:00,' ; }
                        if ($timelist == '17') { $time.= '17:00:00,' ; }
                        if ($timelist == '18') { $time.= '18:00:00,' ; }
                        if ($timelist == '19') { $time.= '19:00:00,' ; }
                        if ($timelist == '20') { $time.= '20:00:00,' ; }
                        if ($timelist == '21') { $time.= '21:00:00,' ; }
                        if ($timelist == '22') { $time.= '22:00:00,' ; }
                        if ($timelist == '23') { $time.= '23:00:00,' ; }
                    }
                    $body1 = 'Hi '.$student->getName().',
                        The lesson '.$lesson->getTitle().' is rescheduled to '.$this->getRequestParameter('date').' at '.$time.'. Please co operate.
                        Thank you,
                        '.$expert->getName().'
                        ';

                    //Grab the user object
                    $expertuser = UserPeer::retrieveByPK($expert->getId());

                    //Send the messages
                    $expertuser->sendMessage($student->getId(),$sub1,$body1);
                }
            }

            return $this->redirect('/expertmanager/history?less_id = '.$this->getRequestParameter('less_id'));
        }
    }

    public function executeSchedule()
    {
        sfProjectConfiguration::getActive()->loadHelpers('Partial');

        $date = $this->getRequestParameter('date');
        $timing = array();
        $timing = $this->getRequestParameter('timing');

        return $this->renderText(get_partial('schedule', array('date' => $date, 'timing' => $timing)));
    }

    public function executeStudentlesson()
    {
        $c = new Criteria();
        $c->add(ExpertsLessonMembersPeer::STUDENT_ID,$this->getUser()->getRaykuUserId());
        $this->lessonids = ExpertsLessonMembersPeer::doSelect($c);
    }

    public function executeStudentreschedule()
    {
        $this->e_id = $this->getRequestParameter('e_id');
        $this->l_id = $this->getRequestParameter('l_id');

        $c = new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('l_id'));
        $this->lesson = ExpertLessonPeer::doSelectOne($c);

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->getRequestParameter('l_id'));
        $this->lesson_shedule = ExpertLessonSchedulePeer::doSelectOne($c);

        if ($this->getRequestParameter('date')) {
            $expert = UserPeer::retrieveByPk($this->getRequestParameter('e_id'));
            $student = UserPeer::retrieveByPk($this->getUser()->getRaykuUserId());
            $lesson = ExpertLessonPeer::retrieveByPk($this->getRequestParameter('l_id'));

            $date = date('d-m-Y',$this->getRequestParameter('date'));
            $timings = implode("|",$this->getRequestParameter('timings'));
            $times = explode('|',$timings);
            $time = '';
            foreach ($times as $timelist) {
                if ($timelist == '0') { $time.= '00:00:00,' ; }
                if ($timelist == '1') { $time.= '01:00:00,' ; }
                if ($timelist == '2') { $time.= '02:00:00,' ; }
                if ($timelist == '3') { $time.= '03:00:00,' ; }
                if ($timelist == '4') { $time.= '04:00:00,' ; }
                if ($timelist == '5') { $time.= '05:00:00,' ; }
                if ($timelist == '6') { $time.= '06:00:00,' ; }
                if ($timelist == '7') { $time.= '07:00:00,' ; }
                if ($timelist == '8') { $time.= '08:00:00,' ; }
                if ($timelist == '9') { $time.= '09:00:00,' ; }
                if ($timelist == '10') { $time.= '10:00:00,' ; }
                if ($timelist == '11') { $time.= '11:00:00,' ; }
                if ($timelist == '12') { $time.= '12:00:00,' ; }
                if ($timelist == '13') { $time.= '13:00:00,' ; }
                if ($timelist == '14') { $time.= '14:00:00,' ; }
                if ($timelist == '15') { $time.= '15:00:00,' ; }
                if ($timelist == '16') { $time.= '16:00:00,' ; }
                if ($timelist == '17') { $time.= '17:00:00,' ; }
                if ($timelist == '18') { $time.= '18:00:00,' ; }
                if ($timelist == '19') { $time.= '19:00:00,' ; }
                if ($timelist == '20') { $time.= '20:00:00,' ; }
                if ($timelist == '21') { $time.= '21:00:00,' ; }
                if ($timelist == '22') { $time.= '22:00:00,' ; }
                if ($timelist == '23') { $time.= '23:00:00,' ; }
            }

            $body1 = 'Hello '.$expert->getName().',
                This is from '.$student->getName().', since i want the  lesson '.$lesson->getTitle().' to be rescheduled to '.$date.' at '.$time.'. Please let me know.
                Thank you,
                '.$student->getName().'
                ';

            $sub1 = 'Needs the lesson '.$lesson->getTitle().' to be rescheduled';

            //Grab the user object
            $user = UserPeer::retrieveByPK($student->getId());

            //Send the messages
            $user->sendMessage($expert->getId(),$sub1,$body1);
            return $this->redirect('expertmanager/studentlesson');
        }
    }

    public function executeCancel()
    {
        $this->less_id = $this->getRequestParameter('less_id');

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::EXPERT_LESSON_ID,$this->less_id);
        $lessons = ExpertLessonSchedulePeer::doSelect($c);

        foreach ($lessons as $lesson) {
            $lesson->delete();
        }

        return $this->redirect('expertmanager/index');
    }

    public function executePaypal()
    {
        $this->expert_id = $this->getRequestParameter('expert_id');
        $this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id');
        $this->lesson_price = $this->getRequestParameter('lesson_price');

        $c = new Criteria();
        $c->add(UserPeer::ID,$this->getUser()->getRaykuUserId());
        $this->user = UserPeer::doSelectOne($c);

    }

    public function executeConfirmation()
    {
        $this->expertid = $this->getRequestParameter('expert_id');
        $this->studentid = $this->getUser()->getRaykuUserId() ;
        $this->expert_lesson_id = $this->getRequestParameter('expert_lesson_id');

        if ($this->getRequestParameter('e_id') != '') {
            $this->e_id = $this->getRequestParameter('e_id');
            $this->l_id = $this->getRequestParameter('l_id');
            $this->amount = $this->getRequestParameter('amt');

            $credits= new ExpertsCreditDetails();
            $credits->setStudentId($this->studentid);
            $credits->setExpertId($this->e_id);
            $credits->setCreditAmount($this->amount);
            $credits->setLessonId($this->l_id);
            $credits->save();

            $c = new Criteria();

            $c->add(ExpertsFinalCreditPeer::EXPERT_ID,$this->e_id);
            $currentfinal = ExpertsFinalCreditPeer::doSelectOne($c);

            if ($currentfinal != NULL) {
                $finalcredit= $currentfinal->getAmount() + $this->amount ;

                $currentfinal->setAmount($finalcredit);
                $currentfinal->save();
            } else {
                $finalcredit = new ExpertsFinalCredit();
                $finalcredit->setExpertId($this->e_id);
                $finalcredit->setAmount($this->amount);
                $finalcredit->save();
            }
        }
    }

    public function executeStudentSchedule()
    {
        $this->sdate= $this->getRequestParameter('date');
        $this->expid = $this->getRequestParameter('expid');
        $this->lessid = $this->getRequestParameter('lessid');

        $c = new Criteria();
        $c->add(ExpertLessonSchedulePeer::DATE,$this->getRequestParameter('date'));
        $c->add(ExpertLessonSchedulePeer::USER_ID,$this->getRequestParameter('expid'));
        $this->lessondates = ExpertLessonSchedulePeer::doSelectOne($c);
    }

    public function executeSenttoexpert()
    {
        $studentexpert = new ExpertStudentSchedules();
        $studentexpert->setExpId($this->getRequestParameter('expid'));
        $studentexpert->setStudentId($this->getUser()->getRaykuUserId());
        $studentexpert->setDate($this->getRequestParameter('date'));
        $studentexpert->setTime($this->getRequestParameter('time'));
        $studentexpert->setMessage($this->getRequestParameter('message'));
        $studentexpert->setExpertLessonId($this->getRequestParameter('lessid'));
        $studentexpert->save();

        $c = new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('lessid'));
        $lesson = ExpertLessonPeer::doSelectOne($c);

        $timing = $this->getRequestParameter('time') ;

        if ($timing == '0') { $time = '(0am-1am)'; }
        if ($timing == '1') { $time = '(1am-2am)'; }
        if ($timing == '2') { $time = '(2am-3am)'; }
        if ($timing == '3') {  $time = '(3am-4am)'; }
        if ($timing == '4') {  $time = '(4am-5am)'; }
        if ($timing == '5') {  $time = '(5am-6am)'; }
        if ($timing == '6') {  $time = '(6am-7am)'; }
        if ($timing == '7') {  $time = '(7am-8am)'; }
        if ($timing == '8') {  $time = '(8am-9am)'; }
        if ($timing == '9') {  $time = '(9am-10am)'; }
        if ($timing == '10') {  $time = '(10am-11am)'; }
        if ($timing == '11') {  $time = '(11am-12pm)'; }
        if ($timing == '12') {  $time = '(12pm-1pm)'; }
        if ($timing == '13') {  $time = '(1pm-2pm)'; }
        if ($timing == '14') {  $time = '(2pm-3pm)'; }
        if ($timing == '15') {  $time = '(3pm-4pm)'; }
        if ($timing == '16') {  $time = '(4pm-5pm)'; }
        if ($timing == '17') {  $time = '(5pm-6pm)'; }
        if ($timing == '18') {  $time = '(6pm-7pm)'; }
        if ($timing == '19') {  $time = '(7pm-8pm)'; }
        if ($timing == '20') {  $time = '(8pm-9pm)'; }
        if ($timing == '21') {  $time = '(9pm-10pm)'; }
        if ($timing == '22') {  $time = '(10pm-11pm)'; }
        if ($timing == '23') {  $time = '(11pm-12pm)'; }

        $currentuser = $this->getUser()->getRaykuUser();

        $subject = 'New Request for a lesson';
        $body = '<table width = "100%" >
            <tr>
            <td width = "48%" style = "border-top:dotted thin; border-color:#666666;">
            <table width = "100%">
            <tr><td><font style = " font-size:12px; color:#CCCCCC;">subject,price</font></td></tr>
            <tr><td><b>'.$lesson->getTitle().'&nbsp;($'. $lesson->getPrice().'/hour)</b></td></tr>
            </table>
            </td>
            <td width = "4%" align = "left" style = "width:0px;border-right:dotted thin; border-color:#666666;">&nbsp;</td>

            <td width = "48%" style = "border-top:dotted thin; border-color:#666666;">
            <table width = "100%">
            <tr><td><font style = " font-size:12px; color:#CCCCCC;">Time</font></td></tr>
            <tr><td><b>'.date('l',$this->getRequestParameter('date')).','.date('Y-m-d',$this->getRequestParameter('date')).'</b></td></tr>
            <tr><td><b>'.$time.'</b></td></tr>
            </table>
            </td>
            </tr>

            <tr>
            <td style = "border-top:dotted thin; border-bottom:dotted thin; border-color:#666666;" colspan = "3">

            Your decision <br>

            <form action = "/expertmanager/expertsapproves" method = "post">

            <input type = "hidden" name = "expid" value = "'.$this->getRequestParameter('expid').'">
            <input type = "hidden" name = "studid" value = "'.$this->getUser()->getRaykuUserId().'">
            <input type = "hidden" name = "lessid" value = "'.$this->getRequestParameter('lessid').'">
            <input type = "hidden" name = "scheduledid" value = "'.$studentexpert->getId().'">
            <input type = "hidden" name = "msgid" value = "'.$this->getRequestParameter('id').'">

            <input type = "submit" name = "accept" value = "Accept">
            <input type = "submit" name = "modify" value = "Modify">
            <input type = "submit" name = "reject" value = "Reject">

            </form>

            </td>
            </tr>

            </table>
            ';
        //Send the message
        $currentuser->sendMessage($this->getRequestParameter('expid'),$subject,$body);
    }

    public function executeExpertsapproves()
    {
        $c = new Criteria();
        $c->add(ExpertLessonPeer::ID,$this->getRequestParameter('lessid'));
        $lesson = ExpertLessonPeer::doSelectOne($c);

        $c = new Criteria();
        $c->add(ExpertStudentSchedulesPeer::ID,$this->getRequestParameter('scheduledid'));
        $schedules = ExpertStudentSchedulesPeer::doSelectOne($c);

        $timing = $schedules->getTime();

        if ($timing == '0') { $time = '(0am-1am)'; }
        if ($timing == '1') {  $time = '(1am-2am)'; }
        if ($timing == '2') {  $time = '(2am-3am)'; }
        if ($timing == '3') {  $time = '(3am-4am)'; }
        if ($timing == '4') {  $time = '(4am-5am)'; }
        if ($timing == '5') {  $time = '(5am-6am)'; }
        if ($timing == '6') {  $time = '(6am-7am)'; }
        if ($timing == '7') {  $time = '(7am-8am)'; }
        if ($timing == '8') {  $time = '(8am-9am)'; }
        if ($timing == '9') {  $time = '(9am-10am)'; }
        if ($timing == '10') {  $time = '(10am-11am)'; }
        if ($timing == '11') {  $time = '(11am-12pm)'; }
        if ($timing == '12') {  $time = '(12pm-1pm)'; }
        if ($timing == '13') {  $time = '(1pm-2pm)'; }
        if ($timing == '14') {  $time = '(2pm-3pm)'; }
        if ($timing == '15') {  $time = '(3pm-4pm)'; }
        if ($timing == '16') {  $time = '(4pm-5pm)'; }
        if ($timing == '17') {  $time = '(5pm-6pm)'; }
        if ($timing == '18') {  $time = '(6pm-7pm)'; }
        if ($timing == '19') {  $time = '(7pm-8pm)'; }
        if ($timing == '20') {  $time = '(8pm-9pm)'; }
        if ($timing == '21') {  $time = '(9pm-10pm)'; }
        if ($timing == '22') {  $time = '(10pm-11pm)'; }
        if ($timing == '23') {  $time = '(11pm-12pm)'; }

        $currentuser = $this->getUser()->getRaykuUser();

        if ($this->getRequestParameter('accept')) {
            $schedules->setAcceptReject(1);
            $schedules->save();

            $subject = 'Lesson scheduled.';
            $body = '<table width = "100%" >
                <tr>
                <td style = "border-top:dotted thin; border-bottom:dotted thin; border-color:#666666;" colspan = "3">
                <b>Lesson Scheduled </b> <br>
                Expert has accepted the lesson schedule.
                </td>
                </tr>

                <tr>

                <td width = "48%" style = "border-top:dotted thin; border-color:#666666;">
                <table width = "100%">
                <tr><td><font style = " font-size:12px; color:#CCCCCC;">subject,price</font></td></tr>
                <tr><td><b>'.$lesson->getTitle().'&nbsp;($'. $lesson->getPrice().'/hour)</b></td></tr>
                </table>
                </td>
                <td width = "4%" align = "left" style = "border-right:dotted thin; border-color:#666666;">&nbsp;</td>

                <td width = "48%" style = "border-top:dotted thin; border-color:#666666;">
                <table width = "100%">
                <tr><td width = "100%"><font style = " font-size:12px; color:#CCCCCC;">Time</font></td></tr>
                <tr><td><b>'.date('l',$schedules->getDate()).','.date('Y-m-d',$schedules->getDate()).'</b></td></tr>
                <tr><td><b>'.$time.'</b></td></tr>
                </table>
                </td>
                </tr>
                </table>
                ';
            //Send the message
            $currentuser->sendMessage($this->getRequestParameter('studid'),$subject,$body);
        }
        if ($this->getRequestParameter('reject')) {
            $c = new Criteria();
            $c->add(ExpertStudentSchedulesPeer::ID,$this->getRequestParameter('scheduledid'));
            $schedules = ExpertStudentSchedulesPeer::doSelectOne($c);

            $schedules->setAcceptReject(0);
            $schedules->save();

            $subject = 'Lesson Schedule has been rejected.';
            $body = '<table width = "100%" >
                <tr>
                <td style = "border-top:dotted thin; border-bottom:dotted thin; border-color:#666666;" colspan = "3">
                <b>Lesson Schedule has been rejected. </b> <br>
                Expert has rejected the lesson schedule.
                </td>
                </tr>

                <tr>

                <td width = "48%" style = "border-top:dotted thin; border-color:#666666;">
                <table width = "100%">
                <tr><td><font style = " font-size:12px; color:#CCCCCC;">subject,price</font></td></tr>
                <tr><td><b>'.$lesson->getTitle().'&nbsp;($'. $lesson->getPrice().'/hour)</b></td></tr>
                </table>
                </td>
                <td width = "4%" align = "left" style = "border-right:dotted thin; border-color:#666666;">&nbsp;</td>

                <td width = "48%" style = "border-top:dotted thin; border-color:#666666;">
                <table width = "100%">
                <tr><td width = "100%"><font style = " font-size:12px; color:#CCCCCC;">Time</font></td></tr>
                <tr><td><b>'.date('l',$schedules->getDate()).','.date('Y-m-d',$schedules->getDate()).'</b></td></tr>
                <tr><td><b>'.$time.'</b></td></tr>
                </table>
                </td>
                </tr>
                </table>
                ';
            //Send the message
            $currentuser->sendMessage($this->getRequestParameter('studid'),$subject,$body);

            $this->redirect('expertmanager/expertsreject');

        }
        if ($this->getRequestParameter('modify')) {
            $this->redirect('expertmanager/modify?id = '.$this->getRequestParameter('scheduledid'));
        }
    }

    public function executeExpertsreject() { }

    public function executeModify() { }

    public function executePromotext()
    {
        $this->expertid= $this->getUser()->getRaykuUser()->getId();
        $this->expertusr= $this->getUser()->getRaykuUser()->getUsername();

        $c= new Criteria();
        $c->add(ExpertsPromoTextPeer::EXP_ID,$this->expertid);
        $this->promotext = ExpertsPromoTextPeer::doSelectOne($c);

        if ($this->getRequestParameter('content') != NULL) {
            $this->content = $this->getRequestParameter('content');

            $c= new Criteria();
            $c->add(ExpertsPromoTextPeer::EXP_ID,$this->expertid);
            $expertstext = ExpertsPromoTextPeer::doSelectOne($c);

            if ($expertstext != NULL) {
                $expertstext->setContent($this->content);
                $expertstext->save();
            } else {
                $promo = new ExpertsPromoText();
                $promo->setExpId($this->expertid);
                $promo->setContent($this->content);
                $promo->save();
            }
            $a = new Criteria();
            $a->add(UserPeer::ID,$this->expertid);
            $users = UserPeer::doSelectOne($a);
            $this->redirect('/expertmanager/portfolio/'.$users->getUsername());
        }
    }
}
