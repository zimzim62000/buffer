<?php


namespace ZIMZIM\Bundles\AppBundle\EventListener;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Event\RequestUserEvent;
use ZIMZIM\Bundles\AppBundle\ZIMZIMAppEvents;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class RequestUserEmailSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $templating;
    private $translator;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, Translator $translator)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->translator = $translator;
    }

    public static function getSubscribedEvents()
    {
        return array(
            ZIMZIMAppEvents::EMAIL_REQUESTUSER => 'onRequestUserSendEmail',
        );
    }

    public function onRequestUserSendEmail(RequestUserEvent $event)
    {
        $requestUser = $event->getRequestUser();

        $message = \Swift_Message::newInstance()
            ->setSubject(
                $this->translator->trans(
                    'views.bundles.app.requestuser.sendrequest.subjectemail',
                    array('%username%' => $requestUser->getUserTournament()->getUser()->getUsername())
                )
            )
            ->setFrom($requestUser->getUserTournament()->getUser()->getEmail())
            ->setTo($requestUser->getEmail())
            ->setBody(
                $this->templating->render(
                    'ZIMZIMBundlesAppBundle:RequestUser:email-invit.html.twig',
                    array('requestUser' => $requestUser)
                ), 'text/html'
            );
        $this->mailer->send($message);

        $event->setRequestUser($requestUser);
    }
}