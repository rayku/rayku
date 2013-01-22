<?php

class SessionActionsTest extends SymfonyActionTestCase
{
    private $whiteboardSessionPeer;
    private $actions;

    protected function setUp()
    {
        parent::setUp();

        $this->whiteboardSessionPeer = mock('WhiteboardSessionPeer');

        $this->actions = new sessionActions($this->context, null, null);
        $this->actions->setWhiteboardSessionPeer($this->whiteboardSessionPeer);
    }

    /**
     * @test
     * @group mocking
     */
    public function shouldReturnAJsonRepresentationOfASession()
    {
        $session = mock('WhiteboardSession');
        when($session)->info()->thenReturn(array('pretend-that' => 'this is a valid session info'));

        when($this->request)->getParameter('token')->thenReturn('aTokenValue');
        when($this->whiteboardSessionPeer)->loadByToken('aTokenValue')->thenReturn($session);

        $this->actions->executeInfo($this->request);

        $json = $this->getResponseContents();
        $this->assertEquals('{"pretend-that":"this is a valid session info"}', $json);
    }
}

?>

