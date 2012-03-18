<?php

class WhiteboardSessionTest extends PHPUnit_Framework_TestCase
{
    /**
     * test
     * database
     * Not running now. Still need to adjust the database configuration
     */
    public function shouldUpdateTheLastActivityWhenKeepingSessionAlive()
    {
        $session = new WhiteboardSession();
        $session->setLastActivity(time());

        $session->keepAlive();

        $this->assertTrue($session->getLastActivity() > time());
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
}
?>

