<?php
namespace Rayku\CommunicationChannel;
use Rayku\User;

/**
 * Checks status of users logged in to WWW
 * @todo - RaykuCommunicationChannelService library is suppose to be standalone but this is not the case now
 *          WWWNotifier is currently using Propel model classes from rayku.com sf1.2 project
 *          In future we should add appropriate API method that will tell us what we need and change this class to use API
 */
class WWWNotifier implements CommunicationChannel
{
    public function getOnlineUsers()
    {
    }

    public function isUserOnline(User $user)
    {
        return $user->isOnline();
    }

    public function sendMessage(User $user, $message)
    {
        
    }

    public function getCCUsername(User $user)
    {
    }

    public function getOnlineUsersCount()
    {
        return \UserPeer::doCount(\UserPeer::getOnlineUsersCriteria());
    }

    public function addFriend($friendUsername)
    {
        throw new Exception('only gtalk add friend is working currently');
    }
}
?>
