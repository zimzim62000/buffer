<?php

namespace ZIMZIM\Test\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\Game;


class LoadGameData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('BRESIL'));
        $game->setTeamOuter($this->getReference('CROATIE'));
        $game->setDate(new \DateTime('2014-06-27 22:00:00'));
        $om->persist($game);
        $this->addReference('game1', $game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('ARGENTINE'));
        $game->setTeamOuter($this->getReference('FRANCE'));
        $game->setDate(new \DateTime('2014-06-28 22:00:00'));
        $om->persist($game);
        $this->addReference('game2', $game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('COLOMBIE'));
        $game->setTeamOuter($this->getReference('CHILI'));
        $game->setDate(new \DateTime('2014-06-29 22:00:00'));
        $om->persist($game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('IRAN'));
        $game->setTeamOuter($this->getReference('MEXIQUE'));
        $game->setDate(new \DateTime('2014-06-30 22:00:00'));
        $om->persist($game);

        $om->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}