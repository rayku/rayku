<?php

class WhiteboardSession extends BaseWhiteboardSession
{
    const TYPE_TUTOR = 1;
    const TYPE_STUDENT = 2;

    public function keepAlive()
    {
        $this->setLastActivity(time());
    }

    public function stillActive()
    {
        return $this->getLastActivity() > (time() - 5);
    }

    public function info()
    {
        $studentQuestion = $this->getStudentQuestion();
        $tutor = $studentQuestion->getTutor();
        $student = $studentQuestion->getStudent();

        $data = array(
            'id' => $this->getId(),
            'question' => $studentQuestion->getQuestion(),
            'session' => array(
                'type' => $this->getType(),
            ),
            'tutor' => array(
                'id' => $tutor->getId(),
                'username' => $tutor->getUsername()
            ),
            'student' => array(
                'id' => $student->getId(),
                'username' => $student->getUsername()
            )
        );
        if ($this->getChatId()) {
            $data['whiteboard-session'] = $this->getChatId();
        }

        return $data;
    }
}

?>
