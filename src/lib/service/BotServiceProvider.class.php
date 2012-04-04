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
 * You can define your local instances by defining self::$bots - see commented definitions
 * 
 * @todo - we should handle cases when any of bot services is not available
 *
 * @author lukas
 */
class BotServiceProvider
{
    private $url;

    /**
     * Definition of all available bots
     * @todo - move this to app.yml or somewhere else outside this class - look out for cronjobs/* because they don't have direct access to app.yml content
     */
    static $bots = array(
//        'gtalk' => array(
//            'prefix' => 'http://www.rayku.com:8892',
//            'serviceUrl' => 'local.gtalk.bot.rayku.com:8892'
//        )
//        ,'facebook' => array(
//            'prefix' => 'http://facebook.rayku.com',
//            'serviceUrl' => 'local.facebook.bot.rayku.com:4567'
//        )
    );
    
    /**
     * @todo Move this config option to a better place - app.yml ?
     */
    static $enabled = false;

    /**
     * If you pass only $url it will be used directly - without any modifications
     * However if you pass $botId then $url should be just the Path + Query part of URL
     * Final URL is builded from serviceURL for given BOT and Query you've passed here
     *
     */
    function __construct($url, $botId = null)
    {
        $this->url = $url;
        $this->botId = $botId;
    }

    function getContent()
    {
        if (!self::$enabled) {
            return json_encode(array());
        }
        $time = time();
        $url = $this->getUrl();
        $content = file_get_contents($url);
        file_put_contents(
            '/tmp/botServiceProvider.log',
            'time: '
                . (time()-$time)
                . ', url: '.$url
                . ', response: '.$content
                ."\n",
            FILE_APPEND
        );
        return $content;
    }

    function getUrl()
    {
        if ($this->botId) {
            return 'http://'.self::$bots[$this->botId]['serviceUrl'] . $this->url;
        } else {
            return $this->url;
        }
    }

    static function createFor($url)
    {
        foreach (self::$bots as $botId => $botParams) {
            if (is_numeric(strpos($url, $botParams['prefix']))) {
                return new self(
                    str_replace($botParams['prefix'], '', $url),
                    $botId
                );
            }
        }

        return new self($url);
    }
}

?>
