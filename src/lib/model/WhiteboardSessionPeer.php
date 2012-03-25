<?php

class WhiteboardSessionPeer extends BaseWhiteboardSessionPeer
{
    public function loadByToken($token)
    {
        $criteria = new Criteria();
        $criteria->add(WhiteboardSessionPeer::TOKEN, $token);

        return $this->doSelectOne($criteria);
    }
}
