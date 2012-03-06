<?php
/**
 * Probably "temporary" class that will help us transition
 * from current "rotten" way to more civilized way of calling any API
 * 
 * I'll put this class in all places where currently we are using file_get_content
 *
 * Extracted base urls of currently existing calls:
 * facebook.rayku.com - facebook bot
 * notification-bot.rayku.com - mac notification bot server
 * www.rayku.com:8892 - gtalk bot 
 *
 *
 * @author lukas
 */
class BotServiceProvider
{
    private $url;

    function __construct($url)
    {
        $this->url = $url;
    }

    function getContent()
    {
        return file_get_contents($this->url);
    }
    
    static function createFor($url)
    {
        return new self($url);
    }
}

?>
