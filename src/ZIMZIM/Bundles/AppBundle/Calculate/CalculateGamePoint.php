<?php

namespace ZIMZIM\Bundles\AppBundle\Calculate;


class CalculateGamePoint
{

    const MAX_POINT = 3;
    const POINT = 1;
    const NULL = 0;

    /**
     * @var \ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet
     */
    private $requestUserBet;

    /**
     * @var \ZIMZIM\Bundles\AppBundle\Entity\Game
     */
    private $game;

    /**
     * @param \ZIMZIM\Bundles\AppBundle\Entity\Game $game
     */
    public function setGame(\ZIMZIM\Bundles\AppBundle\Entity\Game $game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\AppBundle\Entity\Game
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * @param \ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet $requestUserBet
     */
    public function setRequestUserBet(\ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet $requestUserBet)
    {
        $this->requestUserBet = $requestUserBet;

        return $this;
    }

    /**
     * @return \ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet
     */
    public function getRequestUserBet()
    {
        return $this->requestUserBet;
    }


    public function calcul()
    {
        if (null === $this->game->getScoreTeamHome() || null === $this->game->getScoreTeamOuter()) {
            return self::NULL;
        }

        if (null === $this->getRequestUserBet()->getScoreTeamHome() || null === $this->getRequestUserBet(
            )->getScoreTeamOuter()
        ) {
            return self::NULL;
        }

        /**
         * userbet === game
         */
        if ($this->getRequestUserBet()->getScoreTeamHome() === $this->game->getScoreTeamHome() &&
            $this->getRequestUserBet()->getScoreTeamOuter() === $this->game->getScoreTeamOuter()
        ) {
            return self::MAX_POINT;
        }

        /**
         * match null
         */
        if ($this->game->getScoreTeamHome() === $this->game->getScoreTeamOuter()) {
            if ($this->getRequestUserBet()->getScoreTeamHome() === $this->getRequestUserBet()->getScoreTeamOuter()) {
                return self::POINT;
            }
        }

        /**
         * victoire equipe A
         */
        if ($this->game->getScoreTeamHome() > $this->game->getScoreTeamOuter()) {
            if ($this->getRequestUserBet()->getScoreTeamHome() > $this->getRequestUserBet()->getScoreTeamOuter()) {
                return self::POINT;
            }
        }


        /**
         * victoire equipe B
         */
        if ($this->game->getScoreTeamHome() < $this->game->getScoreTeamOuter()) {
            if ($this->getRequestUserBet()->getScoreTeamHome() < $this->getRequestUserBet()->getScoreTeamOuter()) {
                return self::POINT;
            }
        }

        return self::NULL;
    }


}