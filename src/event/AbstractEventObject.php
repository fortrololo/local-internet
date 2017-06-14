<?php

namespace event;

/**
 * Class AbstractEventObject
 * @package event
 */
abstract class AbstractEventObject
{
    /**
     * @var mixed
     */
    private $source;

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }
}