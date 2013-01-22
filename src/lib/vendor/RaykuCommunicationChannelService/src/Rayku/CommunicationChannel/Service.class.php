<?php
namespace Rayku\CommunicationChannel;
use Rayku\User;

/**
 * One and only "entry point" to functionality provided by RaykuCC library
 * 
 * @todo - implement some way to store locally within object cached results of what class is checking
 *          an instance of this object is mostly used during HTTP Request so its existence time is counted in miliseconds
 *          knowing this we can save some calls to our bots by storing results "locally"
 *          example: for Tutor page where we are checking if users is online and also want to know on which channels - this would give tiny improvement
 */
class Service
{
    private $ccS = array();
    
    function __construct()
    {
        $gtalk = new BotNotifier('local.gtalk.bot.rayku.com', sfConfig::get('app_g_chat_port'));
        $gtalk->setType('gtalk');
        
        $fb = new BotNotifier('local.facebook.bot.rayku.com', sfConfig::get('app_fb_chat_port'));
        $fb->setType('fb');
        
        $this->ccS = array(
            'web' => new WWWNotifier(),
            'gtalk' => $gtalk,
            'fb' => $fb,
            'desktop' => new DesktopBotNotifier('192.168.1.100', 80)
        );
    }
    
    /**
     * Checks if $user is currently online
     * 
     * @param User $user
     * @return boolean 
     */
    function isUserOnline(User $user)
    {
        foreach ($this->ccS as $cc) {
            if ($cc->isUserOnline($user)) {
                return true;
            }
        }
    }
    
    /**
     * Returns array with CC Id's for which given $user is currently online
     * 
     * @param User $user
     * @return array
     */
    function getUserOnlineCCs(User $user)
    {
        $ccS = array();
        
        foreach ($this->ccS as $ccType => $cc) {
            if ($cc->isUserOnline($user)) {
                $ccS[] = $ccType;
            }
        }
        
        return $ccS;
    }
    
    /**
     * Returns array with number of online users for each comunication channel
     */
    function getCountsByCC()
    {
        return $this->counts;
    }
    
    function getOnlineUsersCount()
    {
        $cache = \DataCache::getInstance();
        $count = $cache->get('onlineUsersTotalCount');
        
        if ($count === null) {
            $count = 0;
            
            foreach ($this->ccS as $cc) {
                $count += $cc->getOnlineUsersCount();
            }
            
            $cache->set('onlineUsersTotalCount', $count, 60);
        }
        
        return $count;
    }
    
    function getOnlineUsersCountByCC()
    {
        $counts = array();
        foreach ($this->ccS as $ccType => $cc) {
            @$counts[$ccType] += $cc->getOnlineUsersCount();
        }
        return $counts;
    }
    
    /**
     * @return CommunicationChannel
     */
    function getCC($type)
    {
        return $this->ccS[$type];
    }
    
}

?>