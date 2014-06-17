<?php

namespace ZIMZIM\Bundles\AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;

class CheckboxAlignType extends AbstractType
{
    public function getParent()
    {
        return 'entity';
    }

    public function getName()
    {
        return 'zimzim_bundles_appbundle_type_checkboxaligntype';
    }
}