<?php
/**
 * Description of answerAction
 */
class answerAction extends sfAction
{
    public function execute($request)
    {
        $connection = RaykuCommon::getDatabaseConnection();
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
        if (count($details) > 4) {
            $details[2] = base64_decode($details[2]);
            $peer = new StudentQuestionPeer();
            $studentQuestion = $peer->retrieveByPk($this->getRequestParameter('questionId'));

            $questionId = $this->getRequestParameter('questionId');
            $sessionService = new WhiteboardSessionService();
            $session = $sessionService->connect($userId, $questionId);

            mysql_query("delete from user_expert where user_id = " . $userId, $connection) or die(mysql_error());

            $this->getResponse()->setCookie('sessionToken', $session->getToken(), time() + 3600);

            // redirect to rayku whiteboard
            $this->logWhiteboardConnection($userId);
            $this->redirect('http://'.RaykuCommon::getCurrentHttpDomain().':8001/');
        } else {

            $criteria = new Criteria();
            $criteria->add(WhiteboardSessionPeer::CHAT_ID, $details[1]);
            $tutorSession = WhiteboardSessionPeer::doSelectOne($criteria);

            $studentQuestion = $tutorSession->getStudentQuestion();
            $student = $studentQuestion->getStudent();
            $tutor = $studentQuestion->getTutor();

            $this->getResponse()->setCookie('ratingExpertId', $tutor->getId(), time() + 3600);
            $this->getResponse()->setCookie('ratingUserId', $student->getId(), time() + 3600);
            $this->getResponse()->setCookie("askerpoints", $student->getPoints(), time() + 3600);
            $this->getResponse()->setCookie("loginname", $student->getUsername(), time() + 3600);
            $this->getResponse()->setCookie("check_nick", $student->getUsername(), time() + 3600);
            $this->getResponse()->setCookie("chatid", $tutorSession->getChatId(), time() + 3600);

            $sessionService = new WhiteboardSessionService();
            $studentSession = $sessionService->connect($student->getId(), $studentQuestion->getId());
            $studentSession->setChatId($tutorSession->getChatId());
            $studentSession->save();
            $this->getResponse()->setCookie("sessionToken", $studentSession->getToken(), time() + 3600);

            $_record_id = $details[0];
            $_queryRecord = mysql_query("select * from sendmessage where id = ".$_record_id." ", $connection) or die(mysql_error());
            if (mysql_num_rows($_queryRecord)) {
                $row = mysql_fetch_array($_queryRecord);

                $queryUser = mysql_query("select * from user where id = ".$userId." ", $connection) or die("error2".mysql_error());
                $rowUser = mysql_fetch_array($queryUser);

                $queryRPRate = mysql_query("select * from user_rate where userid = ".$row['expert_id']." ", $connection) or die(mysql_error());
                if (mysql_num_rows($queryRPRate)) {
                    $rowRPRate = mysql_fetch_assoc($queryRPRate);
                    $raykuCharge = $rowRPRate['rate'];
                } else {
                    $raykuCharge = '0.16';
                }

                $this->getResponse()->setCookie("raykuCharge", $raykuCharge,time()+3600);

                $this->getResponse()->setCookie("newredirect", 1, time()+  100);
                $this->getResponse()->setCookie("redirection", "", time() - 600);
                $this->getResponse()->setCookie("forumsub", "", time() - 600);

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

    private function logWhiteboardConnection($userId)
    {
        $connection = RaykuCommon::getDatabaseConnection();
        // Connect Whiteboard //
        $insSQL = "INSERT INTO `log_user_connect_whiteboard` (
            `id` ,
            `user_id` ,
            `connect_date_time`,
            `connect_status`
        )
        VALUES (
            NULL ,
            '".$userId."',
            '".date("Y-m-d H:i:s")."',
            '1'
        );";
        mysql_query($insSQL, $connection);
    }
}
