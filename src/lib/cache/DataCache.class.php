<?php
/**
 * This is our "gateway" to memcache service
 * 
 * This class is a wrapper around data cache.
 * Its job is to instantiate class that extends sfCache class
 * Symfony already provides default classes for some most common used cache backends (sf*Cache classes)
 * Any of them can be used. U can configure that in app.yml like that:
all:
  .array:
    data_cache:
      class: sfMemcacheCache
      param:
        param1: param1_value
        param2: param2 value
 *
 * Default configuration is to use sfNoCache class which in fact means that cache is disabled
 *
 */
class DataCache
{
    static $instance;
    /**
     * @var sfCache
     */
    private $cache;

    private function __construct($config)
    {
        $className = $config['class'];
        if (!class_exists($className)) {
            throw new Exception("Provided data cache class ($className) does not exist.");
        }

        $this->cache = new $className($config['param']);
    }

    /**
     * @return DataCache
     */
    static function getInstance()
    {
        if (self::$instance) {
            return self::$instance;
        }

        $config = sfConfig::get('app_data_cache');
        if (!isset($config['class'])) {
            $config['class'] = 'sfNoCache';
        }

        if (!isset($config['param'])) {
            $config['param'] = array();
        }

        $config['param']['prefix'] = "rayku.com";

        self::$instance = new DataCache($config);

        return self::$instance;
    }

    public function set($key, $data, $ttl)
    {
        $this->cache->set($key, $data, $ttl);
    }
    
    /**
     * wipes pit whole cache content
     */
    public function clean()
    {
        $this->cache->clean();
    }

    public function get($key)
    {
        return $this->cache->get($key);
    }
}
?>
