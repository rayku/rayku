<?php
require_once dirname(dirname( __FILE__ )) . '/lib/vendor/symfony1/lib/autoload/sfCoreAutoload.class.php';
require_once dirname(dirname( __FILE__ )) . '/lib/RaykuCommon.class.php';
require_once dirname(dirname( __FILE__ )) . '/lib/service/BotServiceProvider.class.php';
sfCoreAutoload::register();

function checkquestion() {
    $connection = RaykuCommon::getDatabaseConnection();

    $time = time()-300;
    mysql_query("delete from user_expert where status = 7 ", $connection) or die("Error5--1".mysql_error());
    $check_time = time();
    $_expire_msg = mysql_query("select * from user_expire_msg where expire_time <= '".$check_time."'", $connection) or die("Error_Expire1".mysql_error());
    if(mysql_num_rows($_expire_msg) > 0) {
        while($_row_expire_msg = mysql_fetch_assoc($_expire_msg)) {
            $_send_expire_msg = mysql_query("select * from user_gtalk where userid=".$_row_expire_msg['userid'], $connection) or die("Error11".mysql_error());
            if(mysql_num_rows($_send_expire_msg) > 0) {
                $getInfo = mysql_fetch_assoc($_send_expire_msg);
                $_gtalk_email_id = $getInfo['gtalkid'];
                $_exp_newline = urlencode("\n");
                $_exp_message = $_exp_newline;
                $_exp_message .= "This%20question%20has%20expired.";
                $_exp_message .= $_exp_newline;
                $_gtalk_online_check = BotServiceProvider::createFor('http://www.rayku.com:8892/status/'.$_gtalk_email_id)->getContent();
                if($_gtalk_online_check != "offline") {
                    $_send_msg = BotServiceProvider::createFor('http://www.rayku.com:8892/msg/'.$_gtalk_email_id.'/'.$_exp_message)->getContent();
                }
            }

            $fb_query = mysql_query("select * from user_fb where userid=".$_row_expire_msg['userid'], $connection) or die(mysql_error());
            if(mysql_num_rows($fb_query) > 0) {
                $fbRow = mysql_fetch_assoc($fb_query);
                $fb_username = $fbRow['fb_username'];
                $details = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
                $Users = json_decode($details, true);
                foreach($Users as $key => $user) {
                    if($user['username'] == $fb_username){
                        //set POST variables
                        $url = 'http://facebook.rayku.com/tutor/'.$user['uid'].'/message';
                        $fields = array(
                            'message'=> $_exp_message
                        );

                        //url-ify the data for the POST
                        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                        rtrim($fields_string,'&');
                        //open connection
                        $ch = curl_init();
                        //set the url, number of POST vars, POST data
                        curl_setopt($ch,CURLOPT_URL,$url);
                        curl_setopt($ch,CURLOPT_POST,count($fields));
                        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
                        //execute post
                        $result = curl_exec($ch);
                        //close connection
                        curl_close($ch);

                        $flag = 1;

                        break;
                    }
                }
            }

            mysql_query("delete from user_expire_msg where userid=".$_row_expire_msg['userid'], $connection) or die("Error_Expire2".mysql_error());
        }
    }

    $select = mysql_query("select * from gtalkcron where expire_time <= '".$check_time."'", $connection) or die("Error1".mysql_error());
    if(mysql_num_rows($select) > 0) {
        while($rowvalues = mysql_fetch_assoc($select)) {
            $updateId = $rowvalues['id'] + 1;
            $checkprevious = mysql_query("select * from user_expert where id=".$updateId." and user_id=".$rowvalues['userid'], $connection) or die("Error".mysql_error());
            if(mysql_num_rows($checkprevious) > 0) {
                mysql_query("update user_expert set exe_order = 1 where id=".$updateId, $connection) or die("Error2".mysql_error());
            }
            mysql_query("delete from user_expert where id=".$rowvalues['id'], $connection) or die("Error3".mysql_error());
            mysql_query("delete from gtalkcron where id=".$rowvalues['id'], $connection) or die("Error4".mysql_error());
        }
    }

    $query = mysql_query("select * from user_expert where exe_order = 1 and time >= '".$time."' and cron = 1", $connection) or die("Error5".mysql_error());
    if(mysql_num_rows($query) > 0) {
        while($row = mysql_fetch_assoc($query)) {
            $storetime = time();
            $expire_time = '';
            $category = mysql_query("select * from category where id = ".$row['category_id']."", $connection) or die("Error6".mysql_error());
            if(mysql_num_rows($category) > 0) {
                $rowcategory = mysql_fetch_assoc($category);
                $subject = $rowcategory['name'];
            }

            $userdetail = mysql_query("select * from user where id = ".$row['user_id']."", $connection) or die("Error7".mysql_error());
            if(mysql_num_rows($userdetail) > 0) {
                $rowuserdetail = mysql_fetch_assoc($userdetail);
                $email = $rowuserdetail['email'];
            }

            $usercourse = mysql_query("select * from user_course where user_id = ".$row['user_id']."", $connection) or die("Error7".mysql_error());
            $grade = '';
            if(mysql_num_rows($usercourse) > 0) {
                $rowCourse = mysql_fetch_assoc($usercourse);
                $grade = $rowCourse['course_year'];
            }

            $mail = explode("@", $email);
            $newMail = explode(".", $mail[1]);
            if($newMail[0] == "utoronto") {
                $school = "University of Toronto";
            } else if($newMail[1] == "ubc") {
                $school = "UBC";
            }
            $length = strlen(trim($row['question']));
            if($length <= 100) {
                $question = $row['question'];
            } else {
                $question = substr(trim($row['question']), 0, 100);
            }

            $queryUser = mysql_query("select * from user_course where user_id=".$row['user_id']." and course_subject=".$row['category_id'], $connection) or die("Error8".mysql_error());
            $rowUser = mysql_fetch_array($queryUser);

            $userTutor = mysql_query("select * from user where id = ".$row['checked_id']."", $connection) or die("Error9".mysql_error());
            if(mysql_num_rows($userTutor) > 0) {
                $rowuserTutor = mysql_fetch_assoc($userTutor);
                $name  = $rowuserTutor['name'];
                $tutorEmail  = $rowuserTutor['email'];
            }

            $queryRPRate = mysql_query("select * from user_rate where userid=".$row['checked_id']." ", $connection) or die("Error10".mysql_error());
            if(mysql_num_rows($queryRPRate)) {
                $rowRPRate = mysql_fetch_assoc($queryRPRate);
                $raykuCharge = $rowRPRate['rate'];
            } else {
                $raykuCharge = '0.16';
            }
            $final_ques = str_replace(" ","%20", $question);
            $school = str_replace(" ","%20", $school);
            $newline = urlencode("\n");
            $message .= $newline;

            $message = "A%20".$school."%20student%20needs%20your%20help:";
            $message .= $newline;
            $message .= $final_ques."%20%20%20";
            $message .= $newline;

            $detailsFinal = array("0" => $row['checked_id'], "1" => $row['user_id'], "2" => $question, "3" => $school, "4" => $subject, "5" => $rowUser['course_year'], 6 => $row['id'], "7" => $name, "8" => "expert", "9" => $raykuCharge);
            $message .= "Connect:%20";
            $link = "http://www.rayku.com/login/answer?id=".$row['id'];
            $message .= urlencode($link);
            $message .= $newline;
            $message .= "(earns%20you%20$".$raykuCharge."%2Fminute)";
            $message .= $newline;
            $gtalkquery = mysql_query("select * from user_gtalk where userid=".$row['checked_id'], $connection) or die("Error11".mysql_error());
            $onlinecheck = ''; $flag = 1;
            if(mysql_num_rows($gtalkquery) > 0) {
                $status = mysql_fetch_assoc($gtalkquery);
                $gtalkmail = $status['gtalkid'];
                $onlinecheck = BotServiceProvider::createFor('http://www.rayku.com:8892/status/'.$gtalkmail)->getContent();
                if($onlinecheck != "offline") {
                    $testcall = BotServiceProvider::createFor('http://www.rayku.com:8892/msg/'.$gtalkmail.'/'.$message)->getContent();
                    $flag = 1;
                }
            }
            $fb_query = mysql_query("select * from user_fb where userid=".$row['checked_id'], $connection) or die(mysql_error());
            if(mysql_num_rows($fb_query) > 0) {
                $fbRow = mysql_fetch_assoc($fb_query);
                $fb_username = $fbRow['fb_username'];
                $details = BotServiceProvider::createFor("http://facebook.rayku.com/tutor")->getContent();
                $Users = json_decode($details, true);
                foreach($Users as $key => $user) {
                    if($user['username'] == $fb_username){
                        //set POST variables
                        $url = 'http://facebook.rayku.com/tutor/'.$user['uid'].'/message';
                        $fields = array(
                            'message'=> $message
                        );

                        //url-ify the data for the POST
                        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                        rtrim($fields_string,'&');
                        //open connection
                        $ch = curl_init();
                        //set the url, number of POST vars, POST data
                        curl_setopt($ch,CURLOPT_URL,$url);
                        curl_setopt($ch,CURLOPT_POST,count($fields));
                        curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
                        //execute post
                        $result = curl_exec($ch);
                        //close connection
                        curl_close($ch);

                        $flag = 1;

                        break;
                    }
                }
            }
            $onlineUsers = BotServiceProvider::createFor("http://notification-bot.rayku.com/tutor")->getContent();
            $_Users = json_decode($onlineUsers, true);
            foreach($_Users as $key => $_user) {
                if($_user['email'] == $tutorEmail){
                    $url = 'http://notification-bot.rayku.com/tutor/'.$tutorEmail.'/notification';
                    $fields = array(
                        'link'=>urlencode($link),
                        'body'=>urlencode($question),
                        'grade'=>urlencode($grade." year student"),
                        'timeLeft'=> '1'
                    );

                    //url-ify the data for the POST
                    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
                    rtrim($fields_string,'&');
                    //open connection
                    $ch = curl_init();
                    //set the url, number of POST vars, POST data
                    curl_setopt($ch,CURLOPT_URL,$url);
                    curl_setopt($ch,CURLOPT_POST,count($fields));
                    curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
                    //execute post
                    $result = curl_exec($ch);
                    //close connection
                    curl_close($ch);

                    $flag = 1;

                    break;
                }
            }

            if($flag == 1) {
                $expire_time = $row['close']-11;
                $expire_time = ($expire_time/1000) + time();
                mysql_query("insert into gtalkcron(id,userid,expire_time) values(".$row['id'].",".$row['user_id'].",  '".$expire_time."')", $connection) or die("Error12".mysql_error());
                mysql_query("insert into user_expire_msg(userid,expire_time) values(".$row['checked_id'].",  '".$expire_time."')", $connection) or die("Error13".mysql_error());
                mysql_query("update user_expert set cron = 2 where id =".$row['id'], $connection) or die("Error5".mysql_error());
            }
        }
    }
}
$first = checkquestion();
sleep(10);
$second = checkquestion();
sleep(10);
$third = checkquestion();
sleep(10);
$fourth = checkquestion();
sleep(10);
$fifth = checkquestion();
?>
