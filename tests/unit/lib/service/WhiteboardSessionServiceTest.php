<?php

class WhiteboardSessionServiceTest extends PHPUnit_Framework_TestCase
{
    private $tutor;
    private $asker;
    private $studentQuestion;

    protected function setUp()
    {
        parent::setUp();

        $this->tutor = new User();
        $this->tutor->save();
        $this->asker = new User();
        $this->asker->save();

        $this->studentQuestion = new StudentQuestion();
        $this->studentQuestion->setStudent($this->asker);
        $this->studentQuestion->setTutor($this->tutor);
        $this->studentQuestion->save();
    }

    /**
     * @test
     * @group requiresDatabase
     */
    public function shouldGenerateAWhiteboardSessionForATutor()
    {
        $service = new WhiteboardSessionService();
        $session = $service->connect($this->tutor->getId(), $this->studentQuestion->getId());

        $this->assertEquals(WhiteboardSession::TYPE_TUTOR, $session->getType());
        $this->assertNotNull($session->getToken());
        $this->assertEquals($this->studentQuestion, $session->getStudentQuestion());
        $this->assertEquals($this->tutor->getId(), $session->getUserId());
    }

    /**
     * @test
     * @group requiresDatabase
     */
    public function shouldGenerateAWhiteboardSessionForAStudent()
    {
        $service = new WhiteboardSessionService();
        $session = $service->connect($this->asker->getId(), $this->studentQuestion->getId());

        $this->assertEquals(WhiteboardSession::TYPE_STUDENT, $session->getType());
        $this->assertNotNull($session->getToken());
        $this->assertEquals($this->studentQuestion, $session->getStudentQuestion());
        $this->assertEquals($this->asker->getId(), $session->getUserId());
    }
}
