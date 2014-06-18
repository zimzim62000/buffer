<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getManager();

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
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Home:index.html.twig',
            array(
                'Tournaments' => $Tournaments
            )
        );
    }
}
