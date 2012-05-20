<?php
class ratingAction extends sfAction
{
    public function execute($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];
        mysql_query("delete from popup_close where user_id=".$logedUserId, $connection) or die(mysql_error());
        $cookiename= $logedUserId."_question";
        $limitcookiename = $logedUserId."_limit";
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                if (($name != $cookiename) && ($name != $limitcookiename) && ($name != "WRUID") && ($name != "rayku_frontend") && ($name != "ratingExpertId") && ($name != "ratingUserId") && ($name != "timer") && ($name != "practice_name") && ($name != "rEmail") && ($name != "rPassword") && $name != "whiteboardChatId") {
                    $this->getResponse()->setCookie($name, "", time()-3600);
                }
            }
        }

        if (!empty($_POST)) {
            if (empty($_POST["rating"])) {
                $this->redirect('/dashboard/rating');
            }
            if (empty($_COOKIE['ratingExpertId']) && empty($_COOKIE['ratingUserId']) ) {
                $this->redirect('/dashboard');
            } else {
                if (!empty($_COOKIE['raykuCharge'])) {
                    $rate = $_COOKIE['raykuCharge'];
                } else {
                    $queryRPRate = mysql_query("select * from user_rate where userid=".$_COOKIE["ratingExpertId"]." ", $connection) or die(mysql_error());
                    if (mysql_num_rows($queryRPRate)) {
                        $rowRPRate = mysql_fetch_assoc($queryRPRate);
                        $rate = $rowRPRate['rate'];
                    } else {
                        $rate = '0.00';
                    }
                }
                $timer = explode(":", $_COOKIE["timer"]);
                $newTimer = (($timer[0]*3600)+($timer[1]*60)) / 60;
                $raykuPercentage = $newTimer * $rate;
                $_chat_rating = $_POST["rating"];
                $date = date('Y-m-d H:i:s');

                $queryScore = mysql_query("select * from user_score where user_id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                $rowScore = mysql_fetch_assoc($queryScore);

                $queryAsker = mysql_query("select * from user where id=".$_COOKIE["ratingUserId"], $connection) or die(mysql_error());
                $rowAsker = mysql_fetch_assoc($queryAsker);

                $queryExpert = mysql_query("select * from user where id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                $rowExpert = mysql_fetch_assoc($queryExpert);

                $queryKinkarso = mysql_query("select * from user where id=124", $connection) or die(mysql_error());
                $rowKinkarso = mysql_fetch_assoc($queryKinkarso);

                if ($_POST["rating"] == 1) {
                    $check1RatingScore = $rowScore['score'] - 20;
                    if ($check1RatingScore < 1) {
                        $newRatingScore = "1";
                    } else {
                        $newRatingScore = $rowScore['score'] - 20;
                    }
                    mysql_query("update user_score set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                    if ($rate != '0.00') {
                        $kinkarsoPoints = $rowKinkarso["points"] + $raykuPercentage;
                        mysql_query("update user set points = ".$kinkarsoPoints." where id=124", $connection) or die(mysql_error());
                        mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$raykuPercentage.", '".$date."')", $connection) or die(mysql_error());
                    }
                }  elseif ($_POST["rating"] == 2) {
                    $tiptutor=$_POST["tiptutor"];
                    $askerPoints = $rowAsker["points"] - $raykuPercentage;
                    mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"], $connection) or die(mysql_error());
                    $expertPer = ($raykuPercentage * 25) / 100;
                    $kinkarsoPer = ($raykuPercentage * 75) / 100;
                    $expertPoints = $rowExpert["points"] + $expertPer + $tiptutor;
                    $kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;
                    mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                    mysql_query("update user set points = ".$kinkarsoPoints." where id=124", $connection) or die(mysql_error());
                    mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')", $connection) or die(mysql_error());
                } elseif ($_POST["rating"] == 3) {
                    $tiptutor=$_POST["tiptutor"];
                    $_Score = 0;
                    if ($newTimer > 10) {
                        $_Score = 10;
                    } elseif ($newTimer <= 10 && $newTimer >= 2) {
                        $_Score = 4;
                    }

                    if ($rate == '0.00') {
                        $_Score =  $_Score * 2;
                    }
                    $newRatingScore = $rowScore['score'] + $_Score;
                    mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                    if ($rate != '0.00') {
                        $askerPoints = $rowAsker["points"] - $raykuPercentage;
                        mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"], $connection) or die(mysql_error());
                        $expertPer = ($raykuPercentage * 50) / 100;
                        $kinkarsoPer = ($raykuPercentage * 50) / 100;
                        $expertPoints = $rowExpert["points"] + $expertPer +  $tiptutor;
                        $kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;
                        mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                        mysql_query("update user set points = ".$kinkarsoPoints." where id=124", $connection) or die(mysql_error());
                        mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')", $connection) or die(mysql_error());
                    }
                } elseif ($_POST["rating"] == 4) {
                    $tiptutor=$_POST["tiptutor"];
                    $_Score = 0;
                    if ($newTimer > 10) {
                        $_Score = 18;
                    } elseif ($newTimer <= 10 && $newTimer >= 2) {
                        $_Score = 7;
                    }
                    if ($rate == '0.00') {
                        $_Score =  $_Score * 2;
                    }
                    $newRatingScore = $rowScore['score'] + $_Score;
                    mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                    if ($rate != '0.00') {
                        $askerPoints = $rowAsker["points"] - $raykuPercentage;
                        mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"], $connection) or die(mysql_error());
                        $expertPer = ($raykuPercentage * 75) / 100; //60;
                        $kinkarsoPer = ($raykuPercentage * 25) / 100; //40;
                        $expertPoints = $rowExpert["points"] + $expertPer +  $tiptutor;
                        $kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;
                        mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                        mysql_query("update user set points = ".$kinkarsoPoints." where id=124", $connection) or die(mysql_error());
                        mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')", $connection) or die(mysql_error());
                    }
                } elseif ($_POST["rating"] == 5) {
                    $tiptutor=$_POST["tiptutor"];
                    $ratingScore = !empty($rowScore['score']) ? $rowScore['score'] : 0 ;
                    if ($rate != '0.00') {
                        $askerPoints = $rowAsker["points"] - $raykuPercentage;
                        mysql_query("update user set points = ".$askerPoints." where id=".$_COOKIE["ratingUserId"], $connection) or die(mysql_error());

                        $expertPer = $raykuPercentage;  // 5 stars: 100% RP
                        $expertPoints = $rowExpert["points"] + $expertPer +  $tiptutor;
                        $kinkarsoPoints = $rowKinkarso["points"] + $kinkarsoPer;
                        mysql_query("update user set points = ".$expertPoints." where id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                        mysql_query("update user set points = ".$kinkarsoPoints." where id=124", $connection) or die(mysql_error());
                        mysql_query("insert into kinkarso_points(user_id, expert_id, points, date) values(".$_COOKIE["ratingUserId"].", ".$_COOKIE["ratingExpertId"].", ".$kinkarsoPer.", '".$date."')", $connection) or die(mysql_error());
                    }
                    $_Score = 0;
                    if ($newTimer > 10) {
                        $_Score = 25;
                    } elseif ($newTimer <= 10 && $newTimer >= 2) {
                        $_Score = 10;
                    }
                    if ($rate == '0.00') {
                        $_Score =  $_Score * 2;
                    }
                    $newRatingScore = $rowScore['score'] + $_Score;
                    mysql_query("update user_score  set score = ".$newRatingScore." where user_id=".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                }

                if (isset($_POST["checkbox"]) && !empty($_POST["checkbox"])) {
                    if (!empty($_COOKIE["ratingExpertId"]) && !empty($_COOKIE["ratingUserId"])) {
                        $query = mysql_query("select * from expert_subscribers where expert_id = ".$_COOKIE["ratingExpertId"]." and user_id =".$_COOKIE["ratingUserId"], $connection) or die(mysql_error());
                        if (mysql_num_rows($query) == 0) {
                            mysql_query("insert into expert_subscribers(expert_id, user_id) values('".$_COOKIE["ratingExpertId"]."', '".$_COOKIE["ratingUserId"]."')", $connection) or die(mysql_error());
                            $queryScore = mysql_query("select * from user_score where user_id =".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                            $rowScore = mysql_fetch_assoc($queryScore);
                            $newScore = '';
                            $newScore = $rowScore['score'] + 10;
                            mysql_query("update user_score set score = ".$newScore." where user_id =".$_COOKIE["ratingExpertId"], $connection) or die(mysql_error());
                        }
                    }
                }

                if (!empty($_COOKIE["whiteboardChatId"]) && !empty($_COOKIE["whiteboardChatId"])) {
                    $chatId = $_COOKIE["whiteboardChatId"];
                    $_SESSION["whiteboard_Chat_Id"] = $_COOKIE["whiteboardChatId"];
                    if (isset($_POST["chkIsPublic"]) && !empty($_POST["chkIsPublic"])) {
                        $criteria = new Criteria();
                        $criteria->add(WhiteboardChatPeer::ID, $chatId);
                        $chat = WhiteboardChatPeer::doSelectOne($criteria);
                        if ($chat) {
                            $chat->setIsPublic(true);
                            $chat->save();
                        }
                    }
                    $_comments = !empty($_POST['content'])?$_POST['content']:'';
                    $_chat_query = mysql_query("select * from whiteboard_chat where id=".$chatId."", $connection) or("Error In Select".mysql_error());
                    if (mysql_num_rows($_chat_query) > 0) {
                        $_chat_row = mysql_fetch_assoc($_chat_query);
                        mysql_query("update whiteboard_chat set timer = '".$newTimer."', rating = ".$_chat_rating.", amount=".$raykuPercentage.", comments = '".$_comments."' where id=".$chatId." ", $connection) or die(mysql_error());
                    }
                }

                $this->getResponse()->setCookie("timer", "", time()-3600);
                $this->getResponse()->setCookie("whiteboardChatId", "", time()-3600);
                $this->getResponse()->setCookie("ratingExpertId", "", time()-3600);
                $this->getResponse()->setCookie("ratingUserId", "", time()-3600);

                
                
                $this->user = $this->getUser()->getRaykuUser();  
                $this->userPoints = $this->user->getPoints();
                $this->userFirstCharge = $this->user->getFirstCharge();
                if (($this->userPoints < 0)&&(empty($this->userFirstCharge))){
                    $datetime = strtotime($row->createdate);
                    $mysqldate = date("m/d/y g:i A", $datetime);
                    $this->user->setFirstCharge($mysqldate);
                }
                
                
                if ($_chat_rating == 1 || $_chat_rating == 2) {
                    $this->redirect('/dashboard/moneyback');
                }
                $this->redirect('/dashboard');
            }
        }
    }
}
