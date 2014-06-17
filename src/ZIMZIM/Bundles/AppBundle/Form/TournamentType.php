<?php

namespace ZIMZIM\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TournamentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('text')
            ->add('dateStart', 'zimzim_bundles_appbundle_type_datetype' )
            ->add('dateEnd', 'zimzim_bundles_appbundle_type_datetype' )
            ->add('enabled', 'zimzim_bundles_appbundle_type_yesnotype' )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZIMZIM\Bundles\AppBundle\Entity\Tournament',
            'attr' => array(),
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_appbundle_tournamenttype';
    }
}
