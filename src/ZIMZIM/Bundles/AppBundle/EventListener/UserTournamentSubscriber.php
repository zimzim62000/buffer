<?php


namespace ZIMZIM\Bundles\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUser;
use ZIMZIM\Bundles\AppBundle\Event\UserTournamentEvent;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;

class UserTournamentSubscriber implements EventSubscriberInterface
{
    private $em;
    private $requestUser;

    public function __construct(EntityManager $em, RequestUser $requestUser)
    {
        $this->em = $em;
        $this->requestUser = $requestUser;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ZIMZIMAppEvents::CREATE_USERTOURNAMENT => 'onCreateUserTournament',
        );
    }

    public function onCreateUserTournament(UserTournamentEvent $event)
    {
        $userTournament = $event->getUserTournament();

        $requestUser = clone $this->requestUser;

        $requestUser->setUser($userTournament->getUser());
        $requestUser->setUserTournament($userTournament);
        $requestUser->setEnabled(true);
        $requestUser->setValidate(true);
        $this->em->persist($requestUser);
        $this->em->flush();
    }
}