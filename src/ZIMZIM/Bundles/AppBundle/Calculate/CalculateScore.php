<?php

namespace ZIMZIM\Bundles\AppBundle\Calculate;


use Doctrine\ORM\EntityManager;
use ZIMZIM\Bundles\AppBundle\Entity\Game;
use ZIMZIM\Bundles\AppBundle\Entity\RequestUserBet;
use ZIMZIM\Bundles\AppBundle\Entity\Score;

class CalculateScore
{
    private $em;
    private $gamepoint;
    private $score;

    public function __construct(EntityManager $em, CalculateGamePoint $gamepoint, Score $score)
    {
        $this->gamepoint = $gamepoint;
        $this->em = $em;
        $this->score = $score;
    }

    public function calcul(Game $game)
    {

        $requestsUser = $this->em->getRepository('ZIMZIMBundlesAppBundle:RequestUser')->getEnabledByGame($game);


        foreach ($requestsUser as $requestUser) {

            $requestUserBet = $this->em->getRepository(
                'ZIMZIMBundlesAppBundle:RequestUserBet'
            )->findOneBy(
                    array('requestUser' => $requestUser, 'game' => $game)
                );

            if ($requestUserBet instanceOf RequestUserBet) {

                $score = $this->em->getRepository('ZIMZIMBundlesAppBundle:Score')->findOneBy(
                    array('requestUser' => $requestUser, 'game' => $game)
                );


                if (!$score instanceof Score) {
                    $score = clone $this->score;
                    $score->setGame($game);
                    $score->setRequestUser($requestUser);
                }

                $gamePoint = clone $this->gamepoint;
                $gamePoint->setGame($game);
                $gamePoint->setRequestUserBet($requestUserBet);
                $score->setRequestUserBet($requestUserBet);
                $score->setScore($gamePoint->calcul());

                $this->em->persist($score);

            }

        }

        $this->em->flush();

        return true;

    }
}