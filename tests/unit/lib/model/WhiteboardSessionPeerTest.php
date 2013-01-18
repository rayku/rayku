<?php

class WhiteboardSessionPeerTest extends PHPUnit_Framework_TestCase
{

    private $peer;

    private $session;
    private $token = 'someFakeToken';

    protected function setUp()
    {
        parent::setUp();

        $this->peer = new WhiteboardSessionPeer();

        $question = new StudentQuestion();
        $asker = new User();
        $asker->save();
        $question->setStudent($asker);
        $tutor = new User();
        $tutor->save();
        $question->setTutor($tutor);
        $question->save();

        $this->session = new WhiteboardSession();
        $this->session->setUser($asker);
        $this->session->setStudentQuestion($question);
        $this->session->setToken($this->token);
        $this->session->save();
    }

    /**
     * @test
     * @group requiresDatabase
     */
    public function shouldLoadAWhiteboardSessionGivenAToken() {
        $session = $this->peer->loadByToken($this->token);

        $this->assertNotNull($session);
        $this->assertEquals($this->token, $session->getToken());
    }
}

?>

