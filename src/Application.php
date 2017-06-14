<?php

use board\ChessBoard;
use board\Coordinates;
use board\FigureAddingEvent;
use figure\Rook;
use figure\Pawn;
use storage\FileStorage;
use storage\RedisStorage;

class Application
{
    public function run()
    {
        $board = new ChessBoard();

        try {

            $board->add(new Rook(), new Coordinates(1, 1), false, function ($event) {
                if ($event instanceof FigureAddingEvent) {
                    if ($event->getFigure() instanceof Rook) {
                        echo "Rook added \n";
                    } else {
                        echo "Figure added \n";
                    }
                }
            });

            $board->add(new Pawn(), new Coordinates(1, 2));
            $board->add(new Pawn(), new Coordinates(1, 2), true);
            $board->add(new Pawn(), new Coordinates(5, 3));

            $board->move(new Coordinates(1, 2), new Coordinates(5, 3), true);

            $board->remove(new Coordinates(5, 3));



        } catch (Exception $ex) {
            echo $ex->getMessage() . "\n";
        }


        $fileStorage = new FileStorage();
        $redisStorage = new RedisStorage();
        try {
            $fileStorage->push(serialize($board));
            $boardFromFileStorage = unserialize($fileStorage->pull());

            $redisStorage->push(serialize($board));
            $boardFromRedisStorage = unserialize($redisStorage->pull());

        } catch (Exception $ex) {
            echo $ex->getMessage() . "\n";
        }

    }
}