<?php
namespace Rayku\CommunicationChannel;
use Rayku\User;

/**
 * This one is connecting to mac-notification-bot-server to check status of users using desktop app 
 */
class DesktopBotNotifier extends HttpBot implements CommunicationChannel
{
    public function getOnlineUsers()
    {
        $request = $this->createGetRequest('/tutor');
        $response = $this->sendRequest($request);
        return json_decode($response, true);
    }

    public function isUserOnline(User $user)
    {
        $username = $this->getCCUsername($user);
        if ($username == '') {
            return false;
        }
        $request = $this->createGetRequest('/status/'.$username);
        $response = $this->sendRequest($request);
        
        return $response == 'available';
    }

    public function sendMessage(User $user, $message)
    {
        
    }

    public function getCCUsername(User $user)
    {
        return $user->getDesktopCCUsername();
    }

    public function getOnlineUsersCount()
    {
        return count($this->getOnlineUsers());
    }

    public function addFriend($friendUsername)
    {
        throw new Exception('only gtalk add friend is working currently');
    }
}
?>
