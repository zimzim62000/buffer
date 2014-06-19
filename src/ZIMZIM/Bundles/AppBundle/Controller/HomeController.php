<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $context = $this->container->get('security.context');

        $Tournaments = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->getListTournamentActive(
            new \DateTime('now')
        );

        foreach ($Tournaments as $Tournament) {
            $Tournament->setUserTournaments(
                $Tournament->getUserTournaments()->filter(
                    function ($uT) {
                        return $uT->getEnabled() === true;
                    }
                )
            );
            if ($context->isGranted('ROLE_USER')) {
                $user = $context->getToken()->getUser();
                foreach ($Tournament->getUserTournaments() as $UserTournament) {
                    $UserTournament->setRequestsUser(
                        $UserTournament->getRequestsUser()->filter(
                            function ($requestUser) use ($user) {
                                return $requestUser->getUser() === $user;
                            }
                        )
                    );
                }
            }
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Home:index.html.twig',
            array(
                'Tournaments' => $Tournaments
            )
        );
    }
}
