<?php

namespace board;

use figure\AbstractFigure;

/**
 * Class ChessBoard
 *
 * Represents a chess board which can store instances of
 * @see \figure\AbstractFigure. On the addition operations you can pass
 * a callable by last argument.
 *
 * @package board
 */
class ChessBoard
{
    const MIN_COORDINATE = 1;
    const MAX_COORDINATE = 8;

    /**
     * @var AbstractFigure[]
     */
    private $figures;

    /**
     * To get maximum information about the
     * addition event use the callable with the following signature
     *      void function(FigureAddingEvent $event)
     * @see FigureAddingEvent for more information.
     * The 'force' argument substitutes figure if deserved coordinates
     * are occupied. If the 'force' is false - \Exception will be thrown
     *
     * @param AbstractFigure $figure
     * @param Coordinates $coordinates
     * @param bool $force
     * @param callable|null $eventHandler
     * @throws \Exception
     */
    public function add(AbstractFigure $figure, Coordinates $coordinates, $force = false, callable $eventHandler = null)
    {
        if ($this->checkCoordinate($coordinates)) {
            if (($oldFigure = $this->findByCoordinate($coordinates)) && !$force) {
                throw new \Exception(
                    "Requested cell (x = {$coordinates->getX()} y = {$coordinates->getY()})"
                    . " is not empty, contains {$oldFigure}"
                );
            } else {
                $this->figures[$coordinates->getX()][$coordinates->getY()] = $figure;
            }

            if (isset($eventHandler)) {
                $event = $this->createAddingEvent($figure, $coordinates);
                $eventHandler($event);
            }

        } else {
            throw new \Exception("Coordinate out of range");
        }
    }

    /**
     * @param Coordinates $from
     * @param Coordinates $to
     * @param bool $force
     * @throws \Exception
     */
    public function move(Coordinates $from, Coordinates $to, $force = false)
    {
        $figure = $this->findByCoordinate($from);
        if ($figure) {
            $this->add($figure, $to, $force);
            $this->remove($from);
        } else {
            throw new \Exception('Figure has not found');
        }
    }

    /**
     * @param Coordinates $coordinates
     */
    public function remove(Coordinates $coordinates)
    {
        if ($this->findByCoordinate($coordinates)) {
            unset($this->figures[$coordinates->getX()][$coordinates->getY()]);
        }
    }

    /**
     * @param Coordinates $coordinates
     * @return mixed
     */
    public function findByCoordinate(Coordinates $coordinates)
    {
        if (isset($this->figures[$coordinates->getX()][$coordinates->getY()]))
        {
            return $this->figures[$coordinates->getX()][$coordinates->getY()];
        } else {
            return null;
        }
    }

    /**
     * @param Coordinates $coordinates
     * @return bool
     */
    public function checkCoordinate(Coordinates $coordinates)
    {
        $validX = static::MIN_COORDINATE <= $coordinates->getX() &&
            $coordinates->getX() <= static::MAX_COORDINATE;

        $validY = static::MIN_COORDINATE <= $coordinates->getY() &&
            $coordinates->getY() <= static::MAX_COORDINATE;

        if ($validX && $validY) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $figure
     * @param $coordinates
     * @return FigureAddingEvent
     */
    protected function createAddingEvent($figure, $coordinates)
    {
        return new FigureAddingEvent($this, $figure, $coordinates);
    }
}