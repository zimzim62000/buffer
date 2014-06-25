<?php

namespace ZIMZIM\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GameType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tournament')
            ->add('tournamentDay')
            ->add('teamHome')
            ->add('scoreTeamHome', 'zimzim_bundles_appbundle_type_scoretype')
            ->add('scoreTeamOuter', 'zimzim_bundles_appbundle_type_scoretype')
            ->add('teamOuter')
            ->add('date', 'zimzim_bundles_appbundle_type_datetimetype')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ZIMZIM\Bundles\AppBundle\Entity\Game',
            'attr' => array(

            ),
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_appbundle_gametype';
    }
}
