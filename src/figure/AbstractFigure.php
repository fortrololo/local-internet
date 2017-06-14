<?php

namespace figure;

/**
 * Class AbstractFigure
 * @package figure
 */
abstract class AbstractFigure
{
    /**
     * @var string
     */
    protected $id;

    /**
     * return void
     */
    public function generateId()
    {
        $this->id = uniqid();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return static::class . ", id = {$this->id}";
    }
}