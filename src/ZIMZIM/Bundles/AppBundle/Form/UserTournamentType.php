<?php

namespace ZIMZIM\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class UserTournamentType extends AbstractType
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
        $builder
            ->add('name', null, array('label' => 'entity.app.usertournament.name'))
            ->add('text', null, array('label' => 'entity.app.usertournament.text'))
            ->add('bet', null, array('label' => 'entity.app.usertournament.bet'))
            ->add(
                'dateStart',
                'zimzim_bundles_appbundle_type_datetype',
                array(
                    'label' => 'entity.app.usertournament.datestart'
                )
            )
            ->add(
                'dateEnd',
                'zimzim_bundles_appbundle_type_datetype',
                array(
                    'label' => 'entity.app.usertournament.dateend'
                )
            );
        $security = $this->securityContext;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($security) {

                $userRequest = $event->getData();
                $form = $event->getForm();

                if ($security->isGranted('ROLE_ADMIN') === true) {

                    $form->add(
                        'enabled',
                        'zimzim_bundles_appbundle_type_yesnotype',
                        array(
                            'label' => 'entity.app.usertournament.enabled'
                        )
                    )
                        ->add('tournament')
                        ->add('user');
                };
            }
        );
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public
    function setDefaultOptions(
        OptionsResolverInterface $resolver
    ) {
        $resolver->setDefaults(
            array(
                'data_class' => 'ZIMZIM\Bundles\AppBundle\Entity\UserTournament',
                'attr' => array(),
                'cascade_validation' => true
            )
        );
    }

    /**
     * @return string
     */
    public
    function getName()
    {
        return 'zimzim_bundles_appbundle_usertournamenttype';
    }
}
