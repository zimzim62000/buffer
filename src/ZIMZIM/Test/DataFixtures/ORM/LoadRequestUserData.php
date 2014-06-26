<?php

namespace ZIMZIM\Test\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUser;

class LoadRequestUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $om)
    {
        $requestUser = new RequestUser();
        $requestUser->setEnabled(true);
        $requestUser->setValidate(true);
        $requestUser->setUser($this->getReference('zimzim'));
        $requestUser->setEmail($requestUser->getUser()->getEmail());
        $requestUser->setUserTournament($this->getReference('USER1WORLDCUP2014'));
        $om->persist($requestUser);
        $this->addReference('zimzimrequestuser1', $requestUser);

        $requestUser = new RequestUser();
        $requestUser->setEnabled(true);
        $requestUser->setValidate(true);
        $requestUser->setUser($this->getReference('zimzimuser'));
        $requestUser->setEmail($requestUser->getUser()->getEmail());
        $requestUser->setUserTournament($this->getReference('USER1WORLDCUP2014'));
        $om->persist($requestUser);
        $this->addReference('zimzimrequestuser2', $requestUser);

        $requestUser = new RequestUser();
        $requestUser->setEnabled(true);
        $requestUser->setValidate(true);
        $requestUser->setUser($this->getReference('zimzim'));
        $requestUser->setEmail($requestUser->getUser()->getEmail());
        $requestUser->setUserTournament($this->getReference('USER2WORLDCUP2014'));
        $om->persist($requestUser);

        $requestUser = new RequestUser();
        $requestUser->setEnabled(true);
        $requestUser->setValidate(true);
        $requestUser->setUser($this->getReference('zimzimuser'));
        $requestUser->setEmail($requestUser->getUser()->getEmail());
        $requestUser->setUserTournament($this->getReference('USER3WORLDCUP2014'));
        $om->persist($requestUser);

        $requestUser = new RequestUser();
        $requestUser->setEnabled(true);
        $requestUser->setValidate(true);
        $requestUser->setEmail($this->getReference('zimzimuser')->getEmail());
        $requestUser->setUserTournament($this->getReference('USER1WORLDCUP2014'));
        $om->persist($requestUser);

        $om->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}