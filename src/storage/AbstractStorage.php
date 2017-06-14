<?php

namespace storage;

/**
 * Class AbstractStorage
 * @package storage
 */
abstract class AbstractStorage
{
    /**
     * @return string
     */
    protected function getConfigPath()
    {
        return
            'src'
            . DIRECTORY_SEPARATOR
            . 'config'
            . DIRECTORY_SEPARATOR
            . 'storage'
            . DIRECTORY_SEPARATOR;
    }

    /**
     * @param $object
     * @return mixed
     * @throws \Exception
     */
    abstract public function push($object);

    /**
     * @return mixed
     * @throws \Exception
     */
    abstract public function pull();
}