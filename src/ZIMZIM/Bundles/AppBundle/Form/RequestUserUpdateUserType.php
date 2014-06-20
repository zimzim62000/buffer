<?php

namespace ZIMZIM\Bundles\AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class RequestUserUpdateUserType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'enabled',
            'zimzim_bundles_appbundle_type_yesnotype',
            array('label' => 'entity.app.requestuser.enabled')
        )
            ->add(
                'validate',
                'zimzim_bundles_appbundle_type_yesnotype',
                array('label' => 'entity.app.requestuser.validate')
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
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'zimzim_bundles_appbundle_requestuserupdateusertype';
    }
}
