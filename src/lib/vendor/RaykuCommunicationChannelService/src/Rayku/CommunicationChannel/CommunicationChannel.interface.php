<?php
namespace Rayku\CommunicationChannel;
use Rayku\User;

/**
 * Concrete CC must implement this interface
 */
interface CommunicationChannel {
    
    /**
     * Should return true or false 
     */
    function isUserOnline(User $user);
    
    /**
     * Should return array of usernames that are online 
     */
    function getOnlineUsers();
    
    /**
     * Should return total count of online users
     */
    function getOnlineUsersCount();
    
    /**
     * Should send given $message to given user with given $username
     */
    function sendMessage(User $user, $message);
    
    /**
     * Should get username for given CC from User object 
     */
    function getCCUsername(User $user);
    
    /**
     * Should create connection with new friend 
     */
    function addFriend($friendUsername);
}
?>