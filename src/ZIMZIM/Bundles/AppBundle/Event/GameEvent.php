<?php

namespace ZIMZIM\Bundles\AppBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use ZIMZIM\Bundles\AppBundle\Entity\Game;

class GameEvent extends Event
{
    private $game = false;

    /**
     * @param Game $game
     */
    public function setGame(Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return Game
     */
    public function getGame()
    {
        return $this->game;
    }


}