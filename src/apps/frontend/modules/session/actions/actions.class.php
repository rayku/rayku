<?php
/**
 * @subpackage session
 * @author     Diego Feitosa
 */
class sessionActions extends sfActions
{
    public function executeInfo()
    {
        $connection = $this->loadSessionFromRequest();

        $studentQuestion = $connection->getStudentQuestion();
        $tutor = $studentQuestion->getTutor();
        $student = $studentQuestion->getStudent();

        return $this->renderText(json_encode(array(
            'id' => $connection->getId(),
            'question' => $studentQuestion->getQuestion(),
            'session' => array(
                'type' => $connection->getType(),
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

    public function executeKeepAlive() {
    }

    public function executeAddChatId()
    {
        $connection = $this->loadSessionFromRequest();
        $connection->setChatId($this->getRequestParameter('chatId'));
        $connection->save();
        return $this->renderText('');
    }

    private function loadSessionFromRequest()
    {
        $criteria = new Criteria();
        $criteria->add(WhiteboardSessionPeer::TOKEN, $this->getRequestParameter('token'));
        return WhiteboardSessionPeer::doSelectOne($criteria);
    }
}
