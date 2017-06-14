<?php

namespace board;

use event\AbstractEventObject;
use figure\AbstractFigure;

/**
 * Class FigureAddingEvent
 * @package board
 */
class FigureAddingEvent extends AbstractEventObject
{
    /**
     * @var Coordinates
     */
    private $coordinates;
    /**
     * @var AbstractFigure
     */
    private $figure;

    /**
     * FigureAddingEvent constructor.
     * @param mixed $source
     * @param AbstractFigure $figure
     * @param Coordinates $coordinates
     */
    public function __construct($source, AbstractFigure $figure, Coordinates $coordinates)
    {
        $this->setSource($source);
        $this->setFigure($figure);
        $this->setCoordinates($coordinates);
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param Coordinates $coordinates
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return AbstractFigure
     */
    public function getFigure()
    {
        return $this->figure;
    }

    /**
     * @param AbstractFigure $figure
     */
    public function setFigure($figure)
    {
        $this->figure = $figure;
    }
}