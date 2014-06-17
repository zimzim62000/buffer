<?php

namespace ZIMZIM\Bundles\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class YesNoType extends AbstractType
{
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'widget' => 'choice',
                'choices' => array(
                    '0' => 'form.app.type.yesnotype.no',
                    '1' => 'form.app.type.yesnotype.yes'
                ),
                'attr' => array(
                    'label-inline' => 'label-inline',
                ),
                'required' => false
            )
        );
    }


    public function getParent()
    {
        return 'choice';
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_appbundle_type_yesnotype';
    }
}