        $connection = RaykuCommon::getDatabaseConnection();
        if (@$_SESSION['modelPopupOpen']) {
            if (@$_SESSION['popup_session']) {
                $_now = time();
                $_remain_time = $_now - $_SESSION['popup_session'];
                if ($_remain_time < 20) {
                    echo "redirect";
                    $this->redirect('/dashboard');
                }
            } else {
                echo "redirect";
                $this->redirect('/dashboard');
            }
        }
        /* @var $currentUser User */
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $time = time()-300;
        $userGtalk = $currentUser->getUserGtalk();
        $onlinecheck = '';
        if ($userGtalk) {
            $onlinecheck = BotServiceProvider::createFor('http://'.RaykuCommon::getCurrentHttpDomain().':8892/status/'.$userGtalk->getGtalkid())->getContent();
        }

        $query = mysql_query("select * from user_expert where checked_id = ".$userId." and exe_order = 1 and time >= ".$time."", $connection) or die(mysql_error());
        if (mysql_num_rows($query) > 0) {
            $row = mysql_fetch_assoc($query);

            $categories = CategoryPeer::doSelect(new Criteria());

            foreach ( $categories as $category) {
                if ($row['category_id'] == $category->getId()) {
                    $subject = $category->getName();
                }
            }

            //School Selection
            $usr_school_query = mysql_query("select * from user_expert where user_id = ".$row['user_id']."", $connection);
            $usr_school = mysql_fetch_array($usr_school_query);
            $school = $usr_school['school'];

            $length = strlen(trim($row['question']));

            if ($length <= 200) {
                $question = $row['question'];
            } else {
                $question = substr(trim($row['question']), 0, 200);
            }

            $queryUser = mysql_query("select * from user_course where user_id = ".$row['user_id']." and course_subject = ".$row['category_id'], $connection) or die(mysql_error());
            $rowUser = mysql_fetch_array($queryUser);

            $x = new Criteria();
            $x->add(UserPeer::ID,$row['checked_id']);
            $newloginId = UserPeer::doSelectOne($x);
            $queryRPRate = mysql_query("select * from user_rate where userid = ".$userId." ", $connection) or die(mysql_error());

            if (mysql_num_rows($queryRPRate)) {
                $rowRPRate = mysql_fetch_assoc($queryRPRate);
                $raykuCharge = $rowRPRate['rate'];
            } else {
                $raykuCharge = '0.16';
            }

            mysql_query("update user_expert set status = 0 where id = ".$row['id']." ", $connection) or die(mysql_error());

            //User Course Info

            $usr_course_query = mysql_query("select * from user_expert as u join courses as c on u.course_id = c.id where u.user_id = ".$row['user_id']."", $connection);
            $usr_course = mysql_fetch_array($usr_course_query);
            if (!empty($usr_course['year']) && !empty($usr_course['course_code'])) {
                $course_info = $usr_course['course_name'].' | '.$usr_course['year'].' | '.$usr_course['course_code'];
            } else {
                $course_info = $usr_course['course_name'];
            }

            $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];

            $browser = "others";

            if (eregi ("(Chrome/)", $HTTP_USER_AGENT) == true) $browser = "chrome";
            if (eregi ("(Safari/)", $HTTP_USER_AGENT) == true) $browser = "safari";



            $_SESSION["_modelbox"] = $_SESSION["_modelbox"] + 1;

            @setcookie('_popupclose', 1, time()+300, '/', null);
            $question = base64_encode($question);
            echo $row['checked_id']."-".$row['user_id']."-".$question."-".$school."-".$subject."-".$course_info."-".$row['id']."-".$newloginId->getName()."-expert"."-".$raykuCharge."-".$row['close']."-".$browser."-".$_SESSION["_modelbox"];
        }
        exit(0);
