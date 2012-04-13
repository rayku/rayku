<?php

/**
 * login actions.
 *
 * @package    elifes
 * @subpackage login
 * @author     Adam A Flynn <adamaflynn@criticaldevelopment.net>
 */
class tutorActions extends sfActions
{
    public $fb, $user, $session_key, $uid;

    public function preExecute()
    {
    }

    /**
     * Action to display login page
     */
    public function executeIndex()
    {
        $connection = RaykuCommon::getDatabaseConnection();
        if ($this->getRequestParameter('username') == null) {
            $this->redirect("/dashboard");
        }
        $c = new Criteria();
        $c->add(UserPeer::USERNAME, $this->getRequestParameter('username'));
        $user = UserPeer::doSelectOne($c);
        $this->user = $user;
        $tutor_id = $user->getId();
        $this->tutor_id = $user->getId();
        $c = new Criteria();

        $rankexperts = ExpertCategoryPeer::doSelect($c);

        $rankUsers = array(); $ji =0; $newUserLimit = array();  $rankScore = array();
        foreach($rankexperts as $exp){
            if (!in_array($exp->getUserId(), $newUserLimit)) {
                $newUserLimit[] = $exp->getUserId();
                $_query = mysql_query("select * from user_tutor where userid =".$exp->getUserId()." ", $connection) or die(mysql_error());
                if (mysql_num_rows($_query) > 0) {
                    $query = mysql_query("select * from user_score where user_id=".$exp->getUserId(), $connection) or die(mysql_error());
                    $score = mysql_fetch_assoc($query);
                    if ($score['score'] != 0){
                        $dv=new Criteria();
                        $dv->add(UserPeer::ID,$exp->getUserId());
                        $_thisUser = UserPeer::doSelectOne($dv);
                        $rankUsers[$ji] = array("score" => $score['score'], "userid" => $exp->getUserId(), "createdat" => $_thisUser->getCreatedAt());
                        $ji++;
                    }
                }
            }
        }
        asort($rankUsers);
        arsort($rankUsers);
        $this->rankUsers = $rankUsers;
        //////////////////////////////
        if (!empty($_GET['expert_id'])) {
            $_expert_id = !empty($_GET['expert_id']) ? $_GET['expert_id'] : 0;
            $userId = $this->getUser()->getRaykuUserId();
            if ($_expert_id) {
                $query = mysql_query("select * from expert_subscribers where expert_id = ".$_expert_id." and user_id =".$userId, $connection) or die(mysql_error());
                if (mysql_num_rows($query) == 0) {
                    $_query = mysql_query("insert into expert_subscribers(expert_id, user_id) values(".$_expert_id.", ".$userId.")", $connection) or die("Error--->".mysql_error());
                    $queryScore = mysql_query("select * from user_score where user_id =".$_expert_id, $connection) or die(mysql_error());
                    $rowScore = mysql_fetch_assoc($queryScore);
                    $newScore = '';

                    $newScore = $rowScore['score'] + 10;
                    mysql_query("update user_score set score = ".$newScore." where user_id =".$_expert_id, $connection) or die(mysql_error());
                }
            }
            $this->redirect("/tutor/".$user->getUsername());
        }

        if ($this->getRequestParameter('content') != null) {
            $this->expertid = $this->getUser()->getRaykuUser()->getId();
            $this->expertusr= $this->getUser()->getRaykuUser()->getUsername();
            $this->content = $this->getRequestParameter('content');
            $c= new Criteria();
            $c->add(ExpertsPromoTextPeer::EXP_ID,$this->expertid);
            $expertstext = ExpertsPromoTextPeer::doSelectOne($c);

            if ($expertstext != null) {
                $expertstext->setContent($this->content);
                $expertstext->save();
            } else {
                $promo = new ExpertsPromoText();
                $promo->setExpId($this->expertid);
                $promo->setContent($this->content);
                $promo->save();
            }
        }
        $this->expert =  $user;
        $f = new Criteria();
        $f->add(PostPeer::POSTER_ID,$user->getId());
        $f->add(PostPeer::BEST_RESPONSE, '1');
        $f->addDescendingOrderByColumn('ID');
        $this->bestResponses = PostPeer::doSelect($f);
        $f->setLimit(6);
        $this->best_responses = PostPeer::doSelect($f);
        $expertId = $user->getId();
        $userId = $this->getUser()->getRaykuUserId();
        $this->currentUser = $this->getUser()->getRaykuUser();
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

        $this->totalSessions = WhiteboardChatPeer::doSelect($cLastSessions);
        $cLastSessions->setLimit(3);
        $this->lastSessions = WhiteboardChatPeer::doSelect($cLastSessions);
    }

    public function executeFollow()
    {
        RaykuCommon::getDatabaseConnection();
    }
}
