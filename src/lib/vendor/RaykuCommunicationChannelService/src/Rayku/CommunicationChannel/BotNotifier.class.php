<?php
namespace Rayku\CommunicationChannel;
use Rayku\User;

/**
 * This one is contacint our botnotifier piece through HTTP to check either gtalk or fb status 
 */
class BotNotifier extends HttpBot implements CommunicationChannel
{
    /**
     * Must be set to one of 'gtalk' or 'fb'
     */
    private $type;

    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getOnlineUsers()
    {
        $request = $this->createGetRequest('/onlines');
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
        
        return $response == 'online';
    }

    public function sendMessage(User $user, $message)
    {
        
    }

    public function getCCUsername(User $user)
    {
        if ($this->type == 'gtalk') {
            return $user->getGtalkCCUsername();
        } else if ($this->type == 'fb') {
            return $user->getFacebookCCUsername();
        } else {
            throw new \Exception('You must call setType() method on BotNotifier object before you use it. And you must set it to one of supported types.');
        }
        
    }
    
    public function getOnlineUsersCount()
    {
        return count($this->getOnlineUsers());
    }

    /**
     * @todo add errors handling ?
     */
    public function addFriend($friendUsername)
    {
        if ($this->type == 'gtalk') {
            $request = $this->createGetRequest('/add/'.$friendUsername);
            return $this->sendRequest($request);
        } else {
            throw new Exception('only gtalk add friend is working currently');
        }
    }
}
?>
