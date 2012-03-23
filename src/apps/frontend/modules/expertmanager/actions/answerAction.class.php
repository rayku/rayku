<?php
/**
 * expertmanager actions.
 *
 * @package    elifes
 * @subpackage expertmanager
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class answerAction extends sfAction
{
    public function execute($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();
        $logedUserId = $_SESSION['symfony/user/sfUser/attributes']['symfony/user/sfUser/attributes']['user_id'];

        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $time = time();

        $_SESSION["_modelbox"] = 0;

        @setcookie('_popupclose', '', time()-300, '/', null);

        if (@$_SESSION['modelPopupOpen']) {
            unset($_SESSION['modelPopupOpen']);
            if ($_SESSION['popup_session']) {
                unset($_SESSION['popup_session']);
            }
        }
        
        $details =  explode(",", $_REQUEST['details']);

        if ( count($details) > 4 ) {
            $details[2] = base64_decode($details[2]);
            $_record_id = $details[6];
            $query = "select * from user_expert where id = ".$_record_id." ";
            
            $_queryRecord = mysql_query($query, $connection) or die(mysql_error());

            if (mysql_num_rows($_queryRecord)) {
                $newId = $details[6] + 1;
                $asker = UserPeer::retrieveByPK($details[1]);
                /**
                 * @todo - make domain used below in setCookie flexible so we can have it working in development
                 */
                setCookie("question", urlencode($details[2]), time()+3600, '/', "rayku.com");
                $this->getResponse()->setCookie("askerid", $details[1],time()+3600);
                $this->getResponse()->setCookie("askerUsername", $asker->getUsername(), time()+3600);
                $this->getResponse()->setCookie("expertid", $details[0],time()+3600);

                $this->getResponse()->setCookie("check_nick", $asker->getName(), time()+3600);

                $name =  str_replace(" ","", $details[7]);
                $this->getResponse()->setCookie("loginname", $name,time()+3600);
                $query = mysql_query("select * from user_expert where id = ".$details[6]." and user_id = ".$details[1], $connection) or die(mysql_error());

                if (mysql_num_rows($query) > 0) {
                    $row = mysql_fetch_array($query);
                    setcookie("asker_que",$row['question'], time()+600, "/");
                }

                mysql_query("delete from user_expert where user_id = ".$details[1], $connection) or die(mysql_error());

                // Connect Whiteboard //
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
                    '1'
                );";
                mysql_query($insSQL, $connection);
                // redirect to rayku whiteboard
                $this->redirect('http://'.RaykuCommon::getCurrentHttpDomain().':8001/');
            } else {
                // redirect to rayku dashboard
                $this->redirect('/login/answer');
            }
        } else {
            $_record_id = $details[0];
            $_queryRecord = mysql_query("select * from sendmessage where id = ".$_record_id." ", $connection) or die(mysql_error());

            if (mysql_num_rows($_queryRecord)) {
                $query = mysql_query("select * from sendmessage where id = ".$details[0], $connection) or die("error1".mysql_error());
                $row = mysql_fetch_array($query);

                $queryUser = mysql_query("select * from user where id = ".$userId." ", $connection) or die("error2".mysql_error());
                $rowUser = mysql_fetch_array($queryUser);

                $this->getResponse()->setCookie("ratingExpertId", $row['expert_id'],time()+3600);
                $this->getResponse()->setCookie("ratingUserId", $row['asker_id'],time()+3600);

                $queryRPRate = mysql_query("select * from user_rate where userid = ".$row['expert_id']." ", $connection) or die(mysql_error());

                if (mysql_num_rows($queryRPRate)) {
                    $rowRPRate = mysql_fetch_assoc($queryRPRate);
                    $raykuCharge = $rowRPRate['rate'];
                } else {
                    $raykuCharge = '0.16';
                }

                $this->getResponse()->setCookie("raykuCharge", $raykuCharge,time()+3600);

                $a = new Criteria();
                $a->add(UserPeer::ID, $logedUserId);
                $asker = UserPeer::doSelectOne($a);

                $this->getResponse()->setCookie("askerpoints", $rowUser['points'],time()+3600);
                $this->getResponse()->setCookie("newredirect", 1,time()+100);
                $this->getResponse()->setCookie("redirection", "",time()-600);
                $this->getResponse()->setCookie("forumsub", "",time()-600);

                $name =  str_replace(" ","", $rowUser['name']);
                $this->getResponse()->setCookie("loginname", $name,time()+3600);

                $this->getResponse()->setCookie("check_nick", $name, time()+3600);
                $this->getResponse()->setCookie("chatid", $details[1],time()+3600);

                $cookiename = $logedUserId."_question";

                if (!empty($_COOKIE[$cookiename])) {
                    $value = $_COOKIE[$cookiename] + 1;
                    $expire = time()+60*60*24*30;
                    $this->getResponse()->setCookie($cookiename, $value, $expire);
                } else {
                    $expire = time()+60*60*24*30;
                    $this->getResponse()->setCookie($cookiename, 1, $expire);
                }

                if (!empty($userId)) {
                    mysql_query("insert into popup_close(user_id) values(".$userId.")", $connection) or die("error3".mysql_error());
                }

                if (!empty($details[0])) {
                    mysql_query("delete from sendmessage where id = ".$details[0], $connection) or die("error4".mysql_error());
                }

                // redirect to rayku whiteboard
                $this->redirect('http://'.RaykuCommon::getCurrentHttpDomain().':8001/');

            } else {
                $this->redirect('/dashboard');
            }
        }
    }

}
