<?php

namespace Szakdolgozat\FelhasznaloBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SzervezetiEgysegType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("nev", "text", array(
            "label"         =>  "Név",
            "constraints"   =>  new Assert\NotBlank(),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            "data_class" => 'Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgyseg',
        ));
    }

    public function getName()
    {
        return "szervezetiegyseg";
    }
}
