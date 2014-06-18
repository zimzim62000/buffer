<?php


namespace ZIMZIM\Bundles\AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\SecurityContext;

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
}
