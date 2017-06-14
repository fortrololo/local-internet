<?php

namespace figure;

/**
 * Class Pawn
 * @package figure
 */
class Pawn extends AbstractFigure
{
    public function __construct()
    {
        $this->generateId();
    }
}