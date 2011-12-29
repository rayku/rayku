<?php

/**
 * friends actions.
 *
 * @package    elifes
 * @subpackage friends
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class tutorsActions extends sfActions
{
    /**
     * all members database
     */
    public function executeIndex()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $time = time();
        if(!empty($_POST['hidden'])) {
            $count = count($_POST['checkbox']);
            if($count > 2) {
                $close = 21000;
            } else if($count == 2) {
                $close = 31000;
            } else if($count == 1) {
                $close = 61000;
            }

            $j = 0;
            for($i=0; $i < $count; $i++) {
                mysql_query("INSERT INTO `user_expert` (`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close) VALUES ('".$userId."', '".$_POST['checkbox'][$i]."', '5', 'To be discussed','".(++$j)."', '".$time."', 1, ".$close.") ", $connection) or die(mysql_error());
            }
            setcookie("asker_que",$_SESSION['question'], time()+600, "/");
            $this->getResponse()->setCookie("redirection", 1,time()+600);
            $this->getResponse()->setCookie("forumsub", 1,time()+600);
            $this->redirect('expertmanager/connect');
        }

        $this->cat = $this->getRequestParameter('category');
        if(empty($this->cat))
        {
            $this->cat = 1;
        }
        $c = new Criteria();

        if($this->cat==5)
        {
            $experts=ExpertCategoryPeer::doSelect($c);
        }else
        {
            $c->add(ExpertCategoryPeer::CATEGORY_ID,$this->cat);
            $experts = ExpertCategoryPeer::doSelect($c);
        }
        $queryPoints = mysql_query("select * from user where id=".$userId, $connection) or die("Error In rate".mysql_error());

        if(mysql_num_rows($queryPoints) > 0) {
            $rowPoints = mysql_fetch_assoc($queryPoints);
            $_points = $rowPoints['points'];
        }

        $newUser= array(); $i =0; $newUserLimit= array();
        foreach($experts as $exp){
            if($userId != $exp->getUserId()){
                if(!in_array($exp->getUserId(), $newUserLimit)) {
                    $newUserLimit[] = $exp->getUserId();
                    $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ", $connection) or die(mysql_error());
                    if(mysql_num_rows($_query) > 0) {

                        $query = mysql_query("select * from user_score where user_id=".$exp->getUserId(), $connection) or die(mysql_error());
                        $score = mysql_fetch_assoc($query);

                        if($score['score'] != 0){

                            if($_points == '' || $_points == '0.00' ) {

                                $emptyRCquery = mysql_query("select * from user_rate where userid=".$exp->getUserId()." and (rate = 0.00 || rate = 0) ", $connection) or die("Error In rate".mysql_error());

                                if(mysql_num_rows($emptyRCquery) > 0) {

                                    $dv=new Criteria();
                                    $dv->add(UserPeer::ID,$exp->getUserId());
                                    $_thisUser = UserPeer::doSelectOne($dv);

                                    $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());

                                    $i++;

                                }
                            } else {

                                $dv=new Criteria();
                                $dv->add(UserPeer::ID,$exp->getUserId());
                                $_thisUser = UserPeer::doSelectOne($dv);

                                $newUser[$i] = array("score" => $score['score'], "userid" => $exp->getUserId(), "category" => $this->cat, "createdat" => $_thisUser->getCreatedAt());

                                $i++;

                            }
                        }
                    }
                }
            }
        }

        asort($newUser);

        arsort($newUser);



        if($_COOKIE["onoff"] == 1) {

            if(!empty($_COOKIE["school"])) {

                $cookieSchool = array(); $m =0;

                foreach($newUser as $new){
                    $b=new Criteria();
                    $b->add(UserPeer::ID,$new['userid']);
                    $schoolusers=UserPeer::doSelectOne($b);
                    $mail = explode("@", $schoolusers->getEmail());
                    $newMail = explode(".", $mail[1]);
                    $onlinecheck = '';
                    if($schoolusers->isOnline()) {
                        $onlinecheck = "online";
                    }
                    if(empty($onlinecheck)) {
                        $gtalkquery = mysql_query("select * from user_gtalk where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($gtalkquery) > 0) {
                            $status = mysql_fetch_assoc($gtalkquery);
                            $gtalkmail = $status['gtalkid'];
                            $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
                        }
                    }

                    if(empty($onlinecheck) || ($onlinecheck != "online")) {
                        $fb_query = mysql_query("select * from user_fb where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($fb_query) > 0) {
                            $fbRow = mysql_fetch_assoc($fb_query);
                            $fb_username = $fbRow['fb_username'];
                            $details = file_get_contents("http://facebook.rayku.com/tutor");
                            $Users = json_decode($details, true);
                            foreach($Users as $key => $user) {
                                if($user['username'] == $fb_username){
                                    $onlinecheck = 'online';
                                    break;
                                }
                            }
                        }
                    }

                    if($onlinecheck == "online" || $schoolusers->isOnline()) {
                        if(($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
                            $cookieSchool[$m] = $new;
                            $m++;
                        }
                    }
                }

                $this->expert_cats = $cookieSchool;
            } else {
                $cookieOneOn = array(); $j =0;
                foreach($newUser as $new){
                    $a=new Criteria();
                    $a->add(UserPeer::ID,$new['userid']);
                    $users=UserPeer::doSelectOne($a);

                    $onlinecheck = '';
                    if($users->isOnline()) {
                        $onlinecheck = "online";
                    }
                    if(empty($onlinecheck)) {
                        $gtalkquery = mysql_query("select * from user_gtalk where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($gtalkquery) > 0) {
                            $status = mysql_fetch_assoc($gtalkquery);
                            $gtalkmail = $status['gtalkid'];
                            $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
                        }
                    }
                    if(empty($onlinecheck) || ($onlinecheck != "online")) {
                        $fb_query = mysql_query("select * from user_fb where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($fb_query) > 0) {
                            $fbRow = mysql_fetch_assoc($fb_query);
                            $fb_username = $fbRow['fb_username'];
                            $details = file_get_contents("http://facebook.rayku.com/tutor");
                            $Users = json_decode($details, true);
                            foreach($Users as $key => $user) {
                                if($user['username'] == $fb_username){
                                    $onlinecheck = 'online';
                                    break;
                                }
                            }
                        }
                    }

                    if($onlinecheck == "online" || $users->isOnline()) {
                        $cookieOneOn[$j] = $new;
                        $j++;
                    }
                }
                $this->expert_cats = $cookieOneOn;
            }
        } else if($_COOKIE["onoff"] == 2) {
            if(!empty($_COOKIE["school"])) {
                $cookieSchool = array(); $m =0;
                foreach($newUser as $new){
                    $b=new Criteria();
                    $b->add(UserPeer::ID,$new['userid']);
                    $schoolusers=UserPeer::doSelectOne($b);

                    $mail = explode("@", $schoolusers->getEmail());
                    $newMail = explode(".", $mail[1]);
                    $onlinecheck = '';
                    if($schoolusers->isOnline()) {
                        $onlinecheck = "online";
                    }
                    if(empty($onlinecheck)) {


                        $gtalkquery = mysql_query("select * from user_gtalk where userid=".$new['userid'], $connection) or die(mysql_error());

                        if(mysql_num_rows($gtalkquery) > 0) {

                            $status = mysql_fetch_assoc($gtalkquery);

                            $gtalkmail = $status['gtalkid'];

                            $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
                        }

                    }

                    if(empty($onlinecheck) || ($onlinecheck != "online")) {
                        $fb_query = mysql_query("select * from user_fb where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($fb_query) > 0) {
                            $fbRow = mysql_fetch_assoc($fb_query);
                            $fb_username = $fbRow['fb_username'];
                            $details = file_get_contents("http://facebook.rayku.com/tutor");
                            $Users = json_decode($details, true);
                            foreach($Users as $key => $user) {
                                if($user['username'] == $fb_username){
                                    $onlinecheck = 'online';
                                    break;
                                }
                            }
                        }
                    }

                    if($onlinecheck != "online" && !$schoolusers->isOnline()) {
                        if(($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
                            $cookieSchool[$m] = $new;
                            $m++;
                        }
                    }
                }
                $this->expert_cats = $cookieSchool;
            } else {
                $cookieOneOn = array(); $j =0;
                foreach($newUser as $new){
                    $a=new Criteria();
                    $a->add(UserPeer::ID,$new['userid']);
                    $users=UserPeer::doSelectOne($a);

                    $onlinecheck = '';

                    if($users->isOnline()) {
                        $onlinecheck = "online";
                    }
                    if(empty($onlinecheck)) {
                        $gtalkquery = mysql_query("select * from user_gtalk where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($gtalkquery) > 0) {
                            $status = mysql_fetch_assoc($gtalkquery);
                            $gtalkmail = $status['gtalkid'];
                            $onlinecheck = file_get_contents('http://www.rayku.com:8892/status/'.$gtalkmail);
                        }
                    }

                    if(empty($onlinecheck) || ($onlinecheck != "online")) {
                        $fb_query = mysql_query("select * from user_fb where userid=".$new['userid'], $connection) or die(mysql_error());
                        if(mysql_num_rows($fb_query) > 0) {
                            $fbRow = mysql_fetch_assoc($fb_query);
                            $fb_username = $fbRow['fb_username'];
                            $details = file_get_contents("http://facebook.rayku.com/tutor");
                            $Users = json_decode($details, true);
                            foreach($Users as $key => $user) {
                                if($user['username'] == $fb_username){
                                    $onlinecheck = 'online';
                                    break;
                                }
                            }
                        }
                    }
                    if($onlinecheck != "online" && !$users->isOnline()) {
                        $cookieOneOn[$j] = $new;
                        $j++;
                    }
                }

                $this->expert_cats = $cookieOneOn;
            }
        } else {
            if(!empty($_COOKIE["school"])) {
                $cookieSchool = array(); $m =0;
                foreach($newUser as $new){
                    $b=new Criteria();
                    $b->add(UserPeer::ID,$new['userid']);
                    $schoolusers=UserPeer::doSelectOne($b);
                    $mail = explode("@", $schoolusers->getEmail());
                    $newMail = explode(".", $mail[1]);
                    if(($newMail[0] == $_COOKIE["school"]) || ($newMail[1] == $_COOKIE["school"])) {
                        $cookieSchool[$m] = $new;
                        $m++;
                    }
                }
                $this->expert_cats = $cookieSchool;
            } else {
                $this->expert_cats = $newUser;
            }
        }
        $c=new Criteria();
        $c->add(CategoryPeer::ID,$this->cat);
        $this->e=CategoryPeer::doSelectOne($c);
    }
}

