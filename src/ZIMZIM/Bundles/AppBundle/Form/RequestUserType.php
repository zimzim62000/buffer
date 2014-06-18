<?php

namespace ZIMZIM\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class RequestUserType extends AbstractType
{

    private $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $security = $this->securityContext;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($security) {

                $userRequest = $event->getData();
                $form = $event->getForm();

                if ($security->isGranted('ROLE_ADMIN') === true) {
                    $form->add('email', null, array('required' => false))
                        ->add('userTournament')
                        ->add('user', null, array('required' => false))
                        ->add('enabled', 'zimzim_bundles_appbundle_type_yesnotype')
                        ->add('validate', 'zimzim_bundles_appbundle_type_yesnotype');
                }else{
                    if (null !== $userRequest->getId()) {
                        if ($userRequest->getUserTournament()->getUser()->getId() === $security->getToken()->getUser(
                            )->getId()
                        ) {
                            $form->remove('email')
                                ->remove('userTournament')
                                ->remove('user');
                        }
                    }
                }
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\Bundles\AppBundle\Entity\RequestUser',
                'attr' => array(),
                'cascade_validation' => true
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_appbundle_requestusertype';
    }
}
