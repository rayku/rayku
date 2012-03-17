<?php

class WhiteboardSession extends BaseWhiteboardSession
{
    const TYPE_TUTOR = 1;
    const TYPE_STUDENT = 2;

    public function keepAlive()
    {
        $this->setLastActivity(time());
        $this->save();
    }

    public function stillActive()
    {
        return $this->getLastActivity() > (time() - 5);
    }
}
