<?php

class UserGtalkPeer extends BaseUserGtalkPeer
{
    public static function retrieveByUserId($userId)
    {
        return parent::retrieveByPK($userId);
    }
}
