<?php


namespace ZIMZIM\Bundles\AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUser;
use ZIMZIM\Bundles\AppBundle\Event\RequestUserEvent;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;

class RequestUserSubscriber implements EventSubscriberInterface
{
    private $em;
    private $security;
    private $session;

    public function __construct(EntityManager $em, SecurityContext $securityContext, Session $session, Router $router)
    {
        $this->em = $em;
        $this->security = $securityContext;
        $this->session = $session;
        $this->router = $router;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ZIMZIMAppEvents::JOIN_REQUESTUSER => 'onDoRequestUser',
        );
    }

    public function onDoRequestUser(RequestUserEvent $event)
    {
        $em = $this->em;
        $userTournament = $event->getUserTournament();
        $user = $this->security->getToken()->getUser();

        if ($this->security->isGranted('ROLE_USER')) {

            $requestUser = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->findOneBy(
                array(
                    'user' => $user,
                    'userTournament' => $userTournament
                )
            );

            if ($requestUser) {
                $this->session->getFlashBag()->add(
                    'errors',
                    'views.bundles.app.requestuser.join.errorjoin'
                );
                $event->setResponse(new RedirectResponse($this->router->generate('zimzim_bundles_app_home')), 302);
            }

            $requestUser = $em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->findOneBy(
                array(
                    'email' => $user->getEmail(),
                    'userTournament' => $userTournament
                )
            );

            if ($requestUser) {

                $requestUser->setUser($user);
                $em->flush();
                $this->session->getFlashBag()->add(
                    'success',
                    'views.bundles.app.requestuser.join.successemailjoin'
                );
                $event->setResponse(new RedirectResponse($this->router->generate('zimzim_bundles_app_home')), 302);
            }

            $requestUser = new RequestUser();
            $requestUser->setUserTournament($userTournament);
            $requestUser->setUser($user);
            $requestUser->setEnabled(true);
            $requestUser->setValidate(false);
            $event->setRequestUser($requestUser);
        }
    }
}