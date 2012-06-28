<?php

class UserFbPeer extends BaseUserFbPeer
{
    /**
     * @return UserFb
     */
    static function retrieveByUserId($userId)
    {
        $c = new Criteria;
        $c->add(self::USERID, $userId);
        return self::doSelectOne($c);
    }
}
