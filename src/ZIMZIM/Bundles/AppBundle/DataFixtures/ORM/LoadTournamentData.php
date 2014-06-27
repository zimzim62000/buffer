<?php

namespace ZIMZIM\Bundles\AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\Tournament;


class LoadTournamentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $tournament = new Tournament();
        $tournament->setName('FIFA WORLD CUP 2014 PHASE DE POULE');
        $tournament->setText('Coupe du monde de la fifa au brezil en juin 2014');
        $tournament->setDateStart(new \DateTime('2014-06-12'));
        $tournament->setDateEnd(new \DateTime('2014-06-27'));
        $tournament->setEnabled(true);
        $om->persist($tournament);
        $this->addReference('WORLDCUP2014POULE', $tournament);

        $tournament = new Tournament();
        $tournament->setName('FIFA WORLD CUP 2014 PHASE FINALE');
        $tournament->setText('Coupe du monde de la fifa au brezil en juin 2014');
        $tournament->setDateStart(new \DateTime('2014-06-28'));
        $tournament->setDateEnd(new \DateTime('2014-07-13'));
        $tournament->setEnabled(true);
        $om->persist($tournament);
        $this->addReference('WORLDCUP2014FINALE', $tournament);


        $om->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}