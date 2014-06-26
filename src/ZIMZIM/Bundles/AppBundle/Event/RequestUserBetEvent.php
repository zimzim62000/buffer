<?php

namespace ZIMZIM\Bundles\AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class RequestUserBetEvent extends Event
{
    private $requestUserBet = false;

    /**
     * @param boolean $requestUserBet
     */
    public function setRequestUserBet($requestUserBet)
    {
        $this->requestUserBet = $requestUserBet;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequestUserBet()
    {
        return $this->requestUserBet;
    }



}