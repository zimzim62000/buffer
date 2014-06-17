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
            $tmp = $Tournament->getUserTournaments()->filter(
                function ($userTournament) {
                    return $userTournament->getEnabled();
                }
            );
            $Tournament->setUserTournaments($tmp);
        }

        return $this->render(
            'ZIMZIMBundlesAppBundle:Home:index.html.twig',
            array(
                'Tournaments' => $Tournaments
            )
        );
    }
}
