<?php

namespace ZIMZIM\Test\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\Score;

class LoadScoreData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $score = new Score();
        $score->setGame($this->getReference('game1'));
        $score->setRequestUser($this->getReference('zimzimrequestuser1'));
        $score->setRequestUserBet($this->getReference('zimzimrequestuserbet1'));
        $score->setScore(3);
        $om->persist($score);

        $om->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}