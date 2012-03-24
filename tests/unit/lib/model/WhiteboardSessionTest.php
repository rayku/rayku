<?php

class WhiteboardSessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldUpdateTheLastActivityWhenKeepingSessionAlive()
    {
        $session = new WhiteboardSession();
        $session->setLastActivity(time() - 100);

        $session->keepAlive();

        $this->assertTrue($session->getLastActivity() >= time());
    }

    /**
     * @test
     */
    public function sessionIsActiveWhenLastActivityIsLessThanFiveSecondsAgo()
    {
        $session = new WhiteboardSession();
        $session->setLastActivity(time() - 3);

        $this->assertTrue($session->stillActive());
    }

    /**
     * @test
     */
    public function sessionIsInactiveWhenLastActivityWasMoreThanFiveSecondsAgo()
    {
        $session = new WhiteboardSession();
        $session->setLastActivity(time() - 6);

        $this->assertFalse($session->stillActive());
    }

    /**
     * @test
     */
    public function shouldReturnTheSessionInfoAsArray() {
        $tutor = new User();
        $tutor->setId(123);
        $tutor->setUsername('theTutor');

        $asker = new User();
        $asker->setId(456);
        $asker->setUsername('theAsker');

        $question = new StudentQuestion();
        $question->setTutor($tutor);
        $question->setStudent($asker);
        $question->setQuestion('This is a question.');

        $session = new WhiteboardSession();
        $session->setId(999);
        $session->setStudentQuestion($question);
        $session->setType(1);

        $sessionInfo = $session->info();

        $this->assertEquals(999, $sessionInfo['id']);
        $this->assertEquals('This is a question.', $sessionInfo['question']);
        $this->assertEquals(1, $sessionInfo['session']['type']);

        $this->assertEquals(123, $sessionInfo['tutor']['id']);
        $this->assertEquals('theTutor', $sessionInfo['tutor']['username']);

        $this->assertEquals(456, $sessionInfo['student']['id']);
        $this->assertEquals('theAsker', $sessionInfo['student']['username']);

        $this->assertNull($sessionInfo['whiteboard-session']);
    }

    /**
     * @test
     */
    public function shouldIncludeChatIdInSessionInfoWhenAvailable()
    {
        $question = new StudentQuestion();
        $question->setTutor(new User());
        $question->setStudent(new User());

        $session = new WhiteboardSession();
        $session->setStudentQuestion($question);
        $session->setChatId(999000999);

        $sessionInfo = $session->info();

        $this->assertEquals(999000999, $sessionInfo['whiteboard-session']);
    }
}
?>

