<?php

namespace storage;

/**
 * Class RedisStorage
 * @package storage
 */
class RedisStorage extends AbstractStorage
{

    /**
     * @var string[]
     */
    private $settings;

    /**
     * @return string[]
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @param string[] $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }

    /**
     * RedisStorage constructor.
     */
    public function __construct()
    {
        $this->setSettings(require_once $this->getConfigPath() . 'redis.php');
    }

    /**
     * @param mixed $object
     * @return void
     */
    public function push($object)
    {
        $redis = $this->getConnection();
        try {
            $redis->select($this->getSettings()['database']);
            $redis->set($this->getSettings()['key'], $object);
        } finally {
            $redis->close();
        }

    }

    /**
     * @return bool|string
     */
    public function pull()
    {
        $redis = $this->getConnection();
        try {
            $redis->select($this->getSettings()['database']);
            return $redis->get($this->getSettings()['key']);
        } finally {
            $redis->close();
        }

    }

    /**
     * @return \Redis
     * @throws \RedisException
     */
    private function getConnection()
    {
        $redis = new \Redis();
        $redis->connect($this->settings['host']);
        return $redis;
    }

}