<?php

namespace ZIMZIM\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserTournamentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('tournament')
            ->add('text')
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
            )->add(
                'enabled',
                'zimzim_bundles_appbundle_type_yesnotype',
                array(
                    'label' => 'entity.app.usertournament.enabled'
                )
            )
            ->add('user');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
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
    public function getName()
    {
        return 'zimzim_bundles_appbundle_usertournamenttype';
    }
}
