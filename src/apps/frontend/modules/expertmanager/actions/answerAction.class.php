<?php
/**
 * Description of answerAction
 */
class answerAction extends sfAction
{
    public function execute($request)
    {
        RaykuCommon::getDatabaseConnection();
        $currentUser = $this->getUser()->getRaykuUser();
        $userId = $currentUser->getId();
        $time = time();

        $_SESSION["_modelbox"] = 0;

        @setcookie('_popupclose', '', time()-300, '/', sfConfig::get('app_cookies_domain'));

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

            mysql_query("delete from user_expert where user_id = " . $userId) or die(mysql_error());

            $this->getResponse()->setCookie('sessionToken', $session->getToken(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));

            $expertId = $details[0];
            $raykuCharge = $this->getRaykuCharge($expertId);
            $this->getResponse()->setCookie("raykuCharge", $raykuCharge,time()+3600, '/', sfConfig::get('app_cookies_domain'));

            // redirect to rayku whiteboard
            $this->redirect(sfConfig::get('app_whiteboard_url').'/');
        } else {

            $criteria = new Criteria();
            $criteria->add(WhiteboardSessionPeer::CHAT_ID, $details[1]);
            $tutorSession = WhiteboardSessionPeer::doSelectOne($criteria);

            $studentQuestion = $tutorSession->getStudentQuestion();
            $student = $studentQuestion->getStudent();
            $tutor = $studentQuestion->getTutor();

            $this->getResponse()->setCookie('ratingExpertId', $tutor->getId(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie('ratingUserId', $student->getId(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie("askerpoints", $student->getPoints(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie("loginname", $student->getUsername(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie("check_nick", $student->getUsername(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));
            $this->getResponse()->setCookie("chatid", $tutorSession->getChatId(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));

            $sessionService = new WhiteboardSessionService();
            $studentSession = $sessionService->connect($student->getId(), $studentQuestion->getId());
            $studentSession->setChatId($tutorSession->getChatId());
            $studentSession->save();
            $this->getResponse()->setCookie("sessionToken", $studentSession->getToken(), time() + 3600, '/', sfConfig::get('app_cookies_domain'));

            $_record_id = $details[0];
            $_queryRecord = mysql_query("select * from sendmessage where id = ".$_record_id." ") or die(mysql_error());
            if (mysql_num_rows($_queryRecord)) {
                $row = mysql_fetch_array($_queryRecord);

                $raykuCharge = $this->getRaykuCharge($row['expert_id']);
                $this->getResponse()->setCookie("raykuCharge", $raykuCharge,time()+3600, '/', sfConfig::get('app_cookies_domain'));

                $this->getResponse()->setCookie("newredirect", 1, time()+  100, '/', sfConfig::get('app_cookies_domain'));
                $this->getResponse()->setCookie("redirection", "", time() - 600, '/', sfConfig::get('app_cookies_domain'));
                $this->getResponse()->setCookie("forumsub", "", time() - 600, '/', sfConfig::get('app_cookies_domain'));

                if (!empty($userId)) {
                    mysql_query("insert into popup_close(user_id) values(".$userId.")") or die("error3".mysql_error());
                }

                if (!empty($details[0])) {
                    mysql_query("delete from sendmessage where id = ".$details[0]) or die("error4".mysql_error());
                }

                // redirect to rayku whiteboard
                $this->redirect(sfConfig::get('app_whiteboard_url').'/');
            } else {
                $this->redirect('/dashboard');
            }
        }
    }

    private function getRaykuCharge($expertId)
    {
        $user = UserPeer::retrieveByPK($expertId);
        return $user->getRate();
     }
}
