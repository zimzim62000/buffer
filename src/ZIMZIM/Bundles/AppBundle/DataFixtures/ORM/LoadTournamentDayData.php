<?php

namespace ZIMZIM\Bundles\AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\TournamentDay;


class LoadTournamentDayData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $tournamentDay = new TournamentDay();
        $tournamentDay->setName('huitième de finale');
        $om->persist($tournamentDay);
        $this->addReference('8finale', $tournamentDay);

        $tournamentDay = new TournamentDay();
        $tournamentDay->setName('quart de finale');
        $om->persist($tournamentDay);
        $this->addReference('4finale', $tournamentDay);

        $tournamentDay = new TournamentDay();
        $tournamentDay->setName('demi de finale');
        $om->persist($tournamentDay);
        $this->addReference('2finale', $tournamentDay);

        $tournamentDay = new TournamentDay();
        $tournamentDay->setName('finale');
        $om->persist($tournamentDay);
        $this->addReference('finale', $tournamentDay);

        $om->flush();
    }

    public function getOrder()
    {
        return 6;
    }
}