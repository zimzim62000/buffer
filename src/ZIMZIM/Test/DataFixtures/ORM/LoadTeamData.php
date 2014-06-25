<?php

namespace ZIMZIM\Test\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\Team;


class LoadTeamData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $team = new Team();
        $team->setName('ALGERIE');
        $om->persist($team);
        $this->addReference('ALGERIE', $team);

        $team = new Team();
        $team->setName('ALLEMAGNE');
        $om->persist($team);
        $this->addReference('ALLEMAGNE', $team);

        $team = new Team();
        $team->setName('ANGLETERRE');
        $om->persist($team);
        $this->addReference('ANGLETERRE', $team);

        $team = new Team();
        $team->setName('ARGENTINE');
        $om->persist($team);
        $this->addReference('ARGENTINE', $team);

        $team = new Team();
        $team->setName('AUSTRALIE');
        $om->persist($team);
        $this->addReference('AUSTRALIE', $team);

        $team = new Team();
        $team->setName('BELGIQUE');
        $om->persist($team);
        $this->addReference('BELGIQUE', $team);

        $team = new Team();
        $team->setName('BOSNIE');
        $om->persist($team);
        $this->addReference('BOSNIE', $team);



        $team = new Team();
        $team->setName('BRESIL');
        $om->persist($team);
        $this->addReference('BRESIL', $team);

        $team = new Team();
        $team->setName('CAMEROUN');
        $om->persist($team);
        $this->addReference('CAMEROUN', $team);

        $team = new Team();
        $team->setName('CHILI');
        $om->persist($team);
        $this->addReference('CHILI', $team);

        $team = new Team();
        $team->setName('COLOMBIE');
        $om->persist($team);
        $this->addReference('COLOMBIE', $team);

        $team = new Team();
        $team->setName('COREE DU SUD');
        $om->persist($team);
        $this->addReference('COREE DU SUD', $team);

        $team = new Team();
        $team->setName('COSTA RICA');
        $om->persist($team);
        $this->addReference('COSTA RICA', $team);

        $team = new Team();
        $team->setName('CROATIE');
        $om->persist($team);
        $this->addReference('CROATIE', $team);



        $team = new Team();
        $team->setName('CÔTE D IVOIRE');
        $om->persist($team);
        $this->addReference('CÔTE D IVOIRE', $team);

        $team = new Team();
        $team->setName('EQUATEUR');
        $om->persist($team);
        $this->addReference('EQUATEUR', $team);

        $team = new Team();
        $team->setName('ESPAGNE');
        $om->persist($team);
        $this->addReference('ESPAGNE', $team);

        $team = new Team();
        $team->setName('ETATS-UNIS');
        $om->persist($team);
        $this->addReference('ETATS-UNIS', $team);

        $team = new Team();
        $team->setName('FRANCE');
        $om->persist($team);
        $this->addReference('FRANCE', $team);

        $team = new Team();
        $team->setName('GHANA');
        $om->persist($team);
        $this->addReference('GHANA', $team);

        $team = new Team();
        $team->setName('GRECE');
        $om->persist($team);
        $this->addReference('GRECE', $team);



        $team = new Team();
        $team->setName('HONDURAS');
        $om->persist($team);
        $this->addReference('HONDURAS', $team);

        $team = new Team();
        $team->setName('IRAN');
        $om->persist($team);
        $this->addReference('IRAN', $team);

        $team = new Team();
        $team->setName('ITALIE');
        $om->persist($team);
        $this->addReference('ITALIE', $team);

        $team = new Team();
        $team->setName('JAPON');
        $om->persist($team);
        $this->addReference('JAPON', $team);

        $team = new Team();
        $team->setName('MEXIQUE');
        $om->persist($team);
        $this->addReference('MEXIQUE', $team);

        $team = new Team();
        $team->setName('NIGERIA');
        $om->persist($team);
        $this->addReference('NIGERIA', $team);

        $team = new Team();
        $team->setName('PAYS-BAS');
        $om->persist($team);
        $this->addReference('PAYS-BAS', $team);


        $team = new Team();
        $team->setName('PORTUGAL');
        $om->persist($team);
        $this->addReference('PORTUGAL', $team);

        $team = new Team();
        $team->setName('RUSSIE');
        $om->persist($team);
        $this->addReference('RUSSIE', $team);

        $team = new Team();
        $team->setName('SUISSE');
        $om->persist($team);
        $this->addReference('SUISSE', $team);

        $team = new Team();
        $team->setName('URUGUAY');
        $om->persist($team);
        $this->addReference('URUGUAY', $team);

        $om->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}