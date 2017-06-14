<?php

namespace storage;

/**
 * Class FileStorage
 * @package storage
 */
class FileStorage extends AbstractStorage
{
    /**
     * @var string
     */
    private $path;

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * FileStorage constructor.
     * @param $path
     * @throws \Exception
     */
    public function __construct($path = null)
    {
        if (empty($path)) {
            $settings = require_once $this->getConfigPath() .'file.php';
            $this->path = $settings['path'];
        } else {
            $this->path = $path;
        }
    }

    /**
     * @param $object
     * @return void
     * @throws \Exception
     */
    public function push($object)
    {
        if (false === file_put_contents($this->getPath(), $object)) {
            throw new \Exception("Failed to save in file storage");
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function pull()
    {
        if (file_exists($this->getPath())) {
            $content = file_get_contents($this->getPath());
            if (false === $content) {
                throw new \Exception("File exists, but failed to read it");
            } else {
                return $content;
            }
        } else {
            throw new \Exception("File is not found");
        }
    }
}