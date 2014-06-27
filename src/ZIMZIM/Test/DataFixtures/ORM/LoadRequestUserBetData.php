<?php

namespace ZIMZIM\Test\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet;

class LoadRequestUserBetData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $requestUserBet = new RequestUserBet();
        $requestUserBet->setGame($this->getReference('game1'));
        $requestUserBet->setRequestUser($this->getReference('zimzimrequestuser1'));
        $requestUserBet->setScoreTeamHome(3);
        $requestUserBet->setScoreTeamOuter(1);
        $om->persist($requestUserBet);
        $this->addReference('zimzimrequestuserbet1', $requestUserBet);

        $requestUserBet = new RequestUserBet();
        $requestUserBet->setGame($this->getReference('game1'));
        $requestUserBet->setRequestUser($this->getReference('zimzimuserrequestuser1'));
        $requestUserBet->setScoreTeamHome(0);
        $requestUserBet->setScoreTeamOuter(1);
        $om->persist($requestUserBet);

        $requestUserBet = new RequestUserBet();
        $requestUserBet->setGame($this->getReference('game2'));
        $requestUserBet->setRequestUser($this->getReference('zimzimrequestuser2'));
        $requestUserBet->setScoreTeamHome(3);
        $requestUserBet->setScoreTeamOuter(1);
        $om->persist($requestUserBet);

        $requestUserBet = new RequestUserBet();
        $requestUserBet->setGame($this->getReference('game2'));
        $requestUserBet->setRequestUser($this->getReference('zimzimuserrequestuser2'));
        $requestUserBet->setScoreTeamHome(0);
        $requestUserBet->setScoreTeamOuter(1);
        $om->persist($requestUserBet);

        $om->flush();
    }

    public function getOrder()
    {
        return 8;
    }
}