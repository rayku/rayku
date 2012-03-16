<?php
class WhiteboardConnectionService
{
    public function connect($userId, $questionId)
    {
        $question = StudentQuestionPeer::retrieveByPk($questionId);

        $session = new WhiteboardConnection();
        $session->setStudentQuestion($question);
        $session->setType($this->getType($userId, $question));
        $session->setToken($this->generateToken($userId, $questionId));
        $session->setUserId($userId);
        $session->save();

        return $session;
    }

    private function generateToken($userId, $questionId) {
        return sha1($userId . $questionId . time());
    }

    private function getType($userId, $question) {
        $question->getTutor()->getId() == $userId
            ? WhiteboardConnection::TYPE_TUTOR
            : WhiteboardConnection::TYPE_STUDENT;
    }

}
