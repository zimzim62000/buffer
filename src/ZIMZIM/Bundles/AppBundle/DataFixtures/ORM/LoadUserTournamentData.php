<?php

namespace ZIMZIM\Bundles\AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\UserTournament;


class LoadUserTournamentData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $tournament = new UserTournament();
        $tournament->setName('Centaure systems : FIFA WORLD CUP 2014');
        $tournament->setText('Coupe du monde de la fifa au brezil en juin 2014');
        $tournament->setDateStart(new \DateTime('2014-06-12'));
        $tournament->setDateEnd(new \DateTime('2014-07-13'));
        $tournament->setEnabled(true);
        $tournament->setUser($this->getReference('zimzim'));
        $tournament->setTournament($this->getReference('WORLDCUP2014'));
        $om->persist($tournament);


        $tournament = new UserTournament();
        $tournament->setName('Iam the boss 44');
        $tournament->setText('Coupe du monde de la fifa au brezil en juin 2014');
        $tournament->setDateStart(new \DateTime('2014-06-12'));
        $tournament->setDateEnd(new \DateTime('2014-07-13'));
        $tournament->setEnabled(true);
        $tournament->setUser($this->getReference('zimzim'));
        $tournament->setTournament($this->getReference('WORLDCUP2014'));
        $om->persist($tournament);

        $tournament = new UserTournament();
        $tournament->setName('Ca déménage');
        $tournament->setText('Coupe du monde de la fifa au brezil en juin 2014');
        $tournament->setDateStart(new \DateTime('2014-06-12'));
        $tournament->setDateEnd(new \DateTime('2014-07-13'));
        $tournament->setEnabled(true);
        $tournament->setUser($this->getReference('zimzim'));
        $tournament->setTournament($this->getReference('WORLDCUP2014'));
        $om->persist($tournament);

        $tournament = new UserTournament();
        $tournament->setName('PSA ON s\'en fous on gagne nous');
        $tournament->setText('Coupe du monde de la fifa au brezil en juin 2014');
        $tournament->setDateStart(new \DateTime('2014-06-12'));
        $tournament->setDateEnd(new \DateTime('2014-07-13'));
        $tournament->setEnabled(false);
        $tournament->setUser($this->getReference('zimzim'));
        $tournament->setTournament($this->getReference('WORLDCUP2014'));
        $om->persist($tournament);

        $om->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}