<?php

namespace Szakdolgozat\FelhasznaloBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FelhasznaloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("nev", "text", array(
            "label"         =>  "Név",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("email", "email", array(
            "label"         =>  "E-mail cím",
            "constraints"   =>  array(
                new Assert\NotBlank(),
                new Assert\Email(),
            ),
        ));

        $builder->add("szervezeti_egyseg", "text", array(
            "label"         =>  "Szervezeti egység",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("pozicio", "text", array(
            "label"         =>  "Pozíció",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("jogok", "entity", array(
            "class"         =>  "SzakdolgozatFelhasznaloBundle:Jog",
            "expanded"      =>  true,
            "multiple"      =>  true,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            "data_class" => 'Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo',
        ));
    }


    public function getName()
    {
        return "felhasznalo";
    }
}
