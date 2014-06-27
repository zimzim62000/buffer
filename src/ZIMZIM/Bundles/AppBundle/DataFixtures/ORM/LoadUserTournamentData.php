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
        $tournament->setText('Régles: 1point pour victoire/null , 3 points pour score exact,
        Attention en cas de finish au pénalty, le score compte jusqu\'au bout des 120 minutes. Alors tous le monde est préts à parier? A trés bientôt sur parier entre amis !');
        $tournament->setDateStart(new \DateTime('2014-07-28'));
        $tournament->setDateEnd(new \DateTime('2014-07-13'));
        $tournament->setEnabled(true);
        $tournament->setUser($this->getReference('zimzim'));
        $tournament->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $om->persist($tournament);
        $this->addReference('USER1WORLDCUP2014', $tournament);

        $om->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}