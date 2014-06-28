<?php


namespace ZIMZIM\Bundles\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;
use ZIMZIM\Bundles\AppBundle\Entity\Tournament;

class UserTournamentRepository extends EntityRepository
{
    public function getListUserTournamentActive(\DateTime $now){

        $query = $this->createQueryBuilder('ut');
        $query->where('ut.dateStart >= :dateDay')
            ->andWhere('ut.dateEnd <= :dateDay')
            ->andWhere('t.enabled = 1')
            ->setParameter('dateDay', $now)
            ->orderBy('ut.createdAt', 'ASC');
        return $query->getQuery()->getResult();
    }

    public function findByUserAndTournament(SecurityContext $securityContext, Tournament $tournament, $active = false)
    {
        $query = $this->createQueryBuilder('ut');
        $query->join('ut.tournament', 't')
            ->join('ut.requestsUser', 'ru')
            ->where('ru.user = :user')
            ->andWhere('t.id = :id_tournament')
            ->setParameter('user', $securityContext->getToken()->getUser())
            ->setParameter('id_tournament', $tournament->getId());

        if($active){
            $query->andWhere('t.enabled = 1')
                ->andWhere('ut.enabled = 1')
                ->andWhere('ru.enabled = 1')
                ->andWhere('ru.validate = 1');
        }

        return $query->getQuery()->getResult();

    }

}
