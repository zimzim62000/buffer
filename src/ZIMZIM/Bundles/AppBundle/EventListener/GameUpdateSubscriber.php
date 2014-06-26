<?php


namespace ZIMZIM\Bundles\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Event\GameEvent;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;

class GameUpdateSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ZIMZIMAppEvents::UPDATE_SCORE_GAME => 'onDoUpdateScoreGame',
        );
    }

    public function onDoUpdateScoreGame(GameEvent $event)
    {

    }
}