<?php

/**
 * Module responsible for displaying list of tutors and other list related "things"
 */
class tutorsListActions extends sfActions
{
    const MAX_TUTORS_COUNT = 4;
    
    public function executeIndex($request)
    {
        if ($request->isMethod('post')) {
            RaykuCommon::getDatabaseConnection();
            $time = time();
            $selectedTutors = $request->getParameter('checkbox');
            $count = count($selectedTutors);

            if ($count == 4) {
                $close = 46000;
                $_SESSION['connected_tutors'] = 4;
            }
            if ($count == 3) {
                $close = 46000;
            } else if ($count == 2) {
                $close = 61000;
            } else if ($count == 1) {
                $close = 61000;
            } else {
                $close = 61000;
            }
            
            $currentUser = $this->getUser()->getRaykuUser();
            $userId = $currentUser->getId();

            $j = 0;
            foreach ($selectedTutors as $selectedTutorId) {
                mysql_query('INSERT INTO `user_expert` '
                        .'(`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close) '
                        ."VALUES ('$userId', '$selectedTutorId', '5', 'To be discussed','" . (++$j) . "', '$time', 1, $close) ")
                    or die(mysql_error());
            }

            $l = 0;
            $source = 'tutorlist';

            mysql_query("DELETE FROM `student_questions` WHERE user_id=" . $userId . "");

            foreach ($selectedTutors as $selectedTutorId) {
                mysql_query('INSERT INTO `student_questions` '
                        .'(`user_id`, `checked_id`, `category_id`, `question`, `exe_order`, `time`, status, close, source) '
                        ."VALUES ('$userId', '$selectedTutorId', '5', 'To be discussed','" . (++$l) . "', '$time', 1, $close, '$source') ")
                    or die(mysql_error());
            }

//                setcookie("asker_que", $_SESSION['question'], time() + 600, "/", sfConfig::get('app_cookies_domain'));
//
//                $this->getResponse()->setCookie("redirection", 1, time() + 600, '/', sfConfig::get('app_cookies_domain'));
//
//                $this->getResponse()->setCookie("forumsub", 1, time() + 600, '/', sfConfig::get('app_cookies_domain'));

            $this->redirect('tutorsList/connect?count='.$count);
        }
        
    }
    
    public function executeConnect()
    {
        $this->count = $this->getRequestParameter('count');
        StatsD::increment("whiteboard.create");
    }
    
    
    public function executePopup($request)
    {
        $tutorsIds = $request->getParameter('selectedTutorsIds');
        
        if (count($tutorsIds) < 1) {
            return sfView::NONE;
        }
        
        $this->users = UserPeer::retrieveByPKs(array_slice($tutorsIds, 0, self::MAX_TUTORS_COUNT));
        
        if (count($this->users) < 1) {
            return sfView::NONE;
        }
        
        $this->tutorsMissingCount = self::MAX_TUTORS_COUNT - count($this->users);
    }
}