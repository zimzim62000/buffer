<?php

namespace ZIMZIM\Bundles\AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class UserTournamentEvent extends Event
{
    private $userTournament;

    /**
     * @param mixed $userTournament
     */
    public function setUserTournament($userTournament)
    {
        $this->userTournament = $userTournament;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserTournament()
    {
        return $this->userTournament;
    }


}