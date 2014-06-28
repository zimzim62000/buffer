<?php


namespace ZIMZIM\Bundles\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Calculate\CalculateRanking;
use ZIMZIM\Bundles\AppBundle\Calculate\Calculatescore;
use ZIMZIM\Bundles\AppBundle\Entity\Score;
use ZIMZIM\Bundles\AppBundle\Event\GameEvent;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;

class GameUpdateSubscriber implements EventSubscriberInterface
{
    private $em;
    private $calculatescore;
    private $calculranking;


    public function __construct(EntityManager $em, Calculatescore $calculatescore, CalculateRanking $calculranking)
    {
        $this->em = $em;
        $this->calculatescore = $calculatescore;
        $this->calculranking = $calculranking;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ZIMZIMAppEvents::UPDATE_SCORE_GAME => 'onDoUpdateScoreGame',
        );
    }

    public function onDoUpdateScoreGame(GameEvent $event)
    {

        $game = $event->getGame();

        $this->calculatescore->calcul($game);

        $this->calculranking->calcul($game);

    }
}