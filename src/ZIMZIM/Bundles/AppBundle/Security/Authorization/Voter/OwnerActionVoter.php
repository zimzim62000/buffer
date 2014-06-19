<?php

namespace ZIMZIM\Bundles\AppBundle\Security\Authorization\Voter;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OwnerActionVoter implements VoterInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    const ALL = 'access';

    public function supportsAttribute($attribute)
    {
        $action = $attribute[0];

        return $action === self::ALL;
    }

    public function supportsClass($class)
    {
        $supportedClass = '/UserTournament$/';

        return preg_match($supportedClass, $class);
    }

    public function vote(TokenInterface $token, $entity, array $attributes)
    {
        if (!$this->supportsClass(get_class($entity))) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        if (count($attributes) !== 1) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        if (!$this->supportsAttribute($attributes)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return VoterInterface::ACCESS_DENIED;
        }

        if ($entity->getUser() === $user) {
            return VoterInterface::ACCESS_GRANTED;
        }
    }
}