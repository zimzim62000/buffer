<?php

namespace ZIMZIM\Bundles\AppBundle\Form;


use Symfony\Bundle\FrameworkBundle\Translation\Translator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\SecurityContext;

class GameScoreType extends AbstractType
{

    private $security;
    private $translator;

    public function __construct(SecurityContext $securityContext, Translator $translator)
    {
        $this->security = $securityContext;
        $this->translator = $translator;
    }

        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $security = $this->security;
        $translator = $this->translator;

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($security, $translator) {
                $game = $event->getData();
                $form = $event->getForm();

                $labelHome = $translator->trans('entity.app.game.score') . ' '.$game->getTeamHome()->getName();
                $labelOuter = $translator->trans('entity.app.game.score') . ' '.$game->getTeamOuter()->getName();

                $form
                    ->add('scoreTeamHome', 'zimzim_bundles_appbundle_type_scoretype', array('label' => $labelHome))
                    ->add('scoreTeamOuter', 'zimzim_bundles_appbundle_type_scoretype', array('label' => $labelOuter));
            }
        );
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
        return 'zimzim_bundles_appbundle_gamescoretype';
    }
}
