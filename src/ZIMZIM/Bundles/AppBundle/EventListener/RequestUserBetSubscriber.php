<?php


namespace ZIMZIM\Bundles\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet;
use ZIMZIM\Bundles\AppBundle\Event\RequestUserBetEvent;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;

class RequestUserBetSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ZIMZIMAppEvents::BET_ALL_GAME => 'onDoUpdateBetAllGame',
        );
    }

    public function onDoUpdateBetAllGame(RequestUserBetEvent $event)
    {

        $requestUserBet = $event->getRequestUserBet();

        $requestsUser = $this->em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->getByUserAndTournament(
            $requestUserBet->getRequestUser()->getUser(),
            $requestUserBet->getRequestUser()->getUserTournament()->getTournament(),
            true
        );

        foreach ($requestsUser as $requestUser) {

            $rub = $this->em->getRepository('ZIMZIMBundlesAppBundle:RequestUserBet')->findOneBy(
                array('game' => $requestUserBet->getGame(), 'requestUser' => $requestUser)
            );

            if(!$rub instanceof RequestUserBet){
                $rub = new RequestUserBet();
                $rub->setGame($requestUserBet->getGame());
                $rub->setRequestUser($requestUser);
            }
            $rub->setScoreTeamHome($requestUserBet->getScoreTeamHome());
            $rub->setScoreTeamOuter($requestUserBet->getScoreTeamOuter());
            $this->em->persist($rub);
        }

        $this->em->flush();
    }
}