<?php

namespace board;

/**
 * Class Coordinates
 * @package board
 */
class Coordinates
{
    /**
     * @var int
     */
    private $x;
    /**
     * @var int
     */
    private $y;

    /**
     * Coordinates constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct($x, $y)
    {
        $this->setX($x);
        $this->setY($y);
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }
}