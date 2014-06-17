<?php

namespace ZIMZIM\Bundles\UserBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $zimzim = new User();
        $zimzim->setEmail('zimzim62000@gmail.com');
        $zimzim->setPlainPassword('170183');
        $zimzim->addRole('ROLE_ADMIN');
        $zimzim->setEnabled(true);
        $zimzim->setUsername('zimzim');
        $zimzim->setFirstname('Fabien');
        $zimzim->setLastname('Zimmermann');
        $om->persist($zimzim);
        $this->addReference('zimzim', $zimzim);


        $zimzim = new User();
        $zimzim->setEmail('vw@centaure-systems.fr');
        $zimzim->setPlainPassword('GT5Z');
        $zimzim->addRole('ROLE_USER');
        $zimzim->setEnabled(true);
        $zimzim->setUsername('Valentin');
        $zimzim->setFirstname('Valentin');
        $zimzim->setLastname('Wojtkowiak');
        $om->persist($zimzim);
        $this->addReference('valentin', $zimzim);

        $om->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}