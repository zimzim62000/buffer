<?php

namespace ZIMZIM\Bundles\AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class RequestUserEvent extends Event
{
    private $userTournament;
    private $response = false;
    private $requestUser = false;

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

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param boolean $requestUser
     */
    public function setRequestUser($requestUser)
    {
        $this->requestUser = $requestUser;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getRequestUser()
    {
        return $this->requestUser;
    }


}