<?php

namespace ZIMZIM\Bundles\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getManager();

        $Tournaments = $em->getRepository('ZIMZIMBundlesAppBundle:Tournament')->findBy(array('enabled' => 1));

        foreach ($Tournaments as $Tournament) {
            $UserTournaments = $em->getRepository('ZIMZIMBundlesAppBundle:UserTournament')->findBy(
                array(
                    'enabled' => 1,
                    'tournament' => $Tournament
                )
            );
            $Tournament->setUserTournaments($UserTournaments);
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Home:index.html.twig',
            array(
                'Tournaments' => $Tournaments
            )
        );
    }
}
