<?php

namespace ZIMZIM\Bundles\AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\Game;


class LoadGameData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('BRESIL'));
        $game->setTeamOuter($this->getReference('CHILI'));
        $game->setDate(new \DateTime('2014-06-28 18:00:00'));
        $om->persist($game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('COLOMBIE'));
        $game->setTeamOuter($this->getReference('URUGUAY'));
        $game->setDate(new \DateTime('2014-06-28 22:00:00'));
        $om->persist($game);


        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('PAYS-BAS'));
        $game->setTeamOuter($this->getReference('MEXIQUE'));
        $game->setDate(new \DateTime('2014-06-29 18:00:00'));
        $om->persist($game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('COSTA RICA'));
        $game->setTeamOuter($this->getReference('GRECE'));
        $game->setDate(new \DateTime('2014-06-29 22:00:00'));
        $om->persist($game);


        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('FRANCE'));
        $game->setTeamOuter($this->getReference('NIGERIA'));
        $game->setDate(new \DateTime('2014-06-30 18:00:00'));
        $om->persist($game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('ALLEMAGNE'));
        $game->setTeamOuter($this->getReference('ALGERIE'));
        $game->setDate(new \DateTime('2014-06-30 22:00:00'));
        $om->persist($game);


        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('ARGENTINE'));
        $game->setTeamOuter($this->getReference('SUISSE'));
        $game->setDate(new \DateTime('2014-07-01 18:00:00'));
        $om->persist($game);

        $game = new Game();
        $game->setTournament($this->getReference('WORLDCUP2014FINALE'));
        $game->setTournamentDay($this->getReference('8finale'));
        $game->setTeamHome($this->getReference('BELGIQUE'));
        $game->setTeamOuter($this->getReference('ETATS-UNIS'));
        $game->setDate(new \DateTime('2014-07-01 22:00:00'));
        $om->persist($game);

        $om->flush();
    }

    public function getOrder()
    {
        return 7;
    }
}