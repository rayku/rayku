<?php
/**
 * @subpackage session
 * @author     Diego Feitosa
 */
class sessionActions extends sfActions
{
    public function executeInfo()
    {
        $connection = $this->loadConnectionFromRequest();

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
        $connection = $this->loadConnectionFromRequest();
        $connection->setChatId($this->getRequestParameter('chatId'));
        $connection->save();
        return $this->renderText('');
    }

    private function loadConnectionFromRequest()
    {
        $criteria = new Criteria();
        $criteria->add(WhiteboardConnectionPeer::TOKEN, $this->getRequestParameter('token'));
        return WhiteboardConnectionPeer::doSelectOne($criteria);
    }
}
