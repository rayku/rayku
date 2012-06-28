<?php
namespace Rayku\CommunicationChannel;

class HttpBot
{
    private $curlConnectTimeout = 1;
    private $curlTimeout = 3;

    private $logging = true;
    private $logFilePath = '/tmp/botServiceProvider2.log';
    
    private $client;
    
    function __construct($host, $port)
    {
        $baseUrl = "http://$host";
        if ($port) {
            $baseUrl .= ":$port";
        }
        /**
         * @todo - autoload guzzle library! 
         */
        require_once dirname(dirname(dirname(dirname(__DIR__)))).'/guzzle/guzzle.phar';
        $this->client = new \Guzzle\Service\Client($baseUrl);
    }
    
    function createGetRequest($url)
    {
        $request = $this->client->get($url);
        $request->getCurlOptions()->set(CURLOPT_CONNECTTIMEOUT, $this->curlConnectTimeout);
        $request->getCurlOptions()->set(CURLOPT_TIMEOUT, $this->curlTimeout);
        return $request;
    }
    
    function sendRequest($request)
    {
        $time = time();
        try {
            $response = $request->send();
        } catch(\Guzzle\Http\Exception\BadResponseException $e) {
            if ($this->logging) {
                file_put_contents(
                    $this->logFilePath,
                    'time: '
                        . (time()-$time)
                        . ', url: '.$request->getUrl()
                        . ', exception: '.$e->getMessage()
                        ."\n",
                    FILE_APPEND
                );
            }
            return '[]';
        }
         
        $content = $response->getBody(true);
        
        if ($this->logging) {
            file_put_contents(
                $this->logFilePath,
                'time: '
                    . (time()-$time)
                    . ', url: '.$request->getUrl()
                    . ', response: '.$content
                    ."\n",
                FILE_APPEND
            );
        }
        
        return $content;
    }
}
?>
