<?php
/**
 * @subpackage session
 * @author     Diego Feitosa
 */
class sessionActions extends sfActions
{
    public function executeInfo()
    {
        $session = $this->loadSession();

        $studentQuestion = $session->getStudentQuestion();
        $tutor = $studentQuestion->getTutor();
        $student = $studentQuestion->getStudent();

        return $this->renderText(json_encode(array(
            'id' => $session->getId(),
            'question' => $studentQuestion->getQuestion(),
            'session' => array(
                'type' => $session->getType(),
            ),
            'tutor' => array(
                'id' => $tutor->getId(),
                'username' => $tutor->getUsername()
            ),
            'student' => array(
                'id' => $student->getId(),
                'username' => $student->getUsername()
            )
        )));
    }

    public function executeKeepAlive()
    {
        $session = $this->loadSession();
        $session->keepAlive();

        return sfView::HEADER_ONLY;
    }

    public function executeAddChatId()
    {
        $session = $this->loadSession();
        $session->setChatId($this->getRequestParameter('chatId'));
        $session->save();

        return sfView::HEADER_ONLY;
    }

    private function loadSession()
    {
        $criteria = new Criteria();
        $criteria->add(WhiteboardSessionPeer::TOKEN, $this->getRequestParameter('token'));

        return WhiteboardSessionPeer::doSelectOne($criteria);
    }

}
