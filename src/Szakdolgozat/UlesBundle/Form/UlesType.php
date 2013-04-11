<?php

namespace Szakdolgozat\UlesBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class UlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("nev", "text", array(
            "label"         =>  "Név",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("leiras", "textarea", array(
            "label"         =>  "Leírás",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("datum", "datetime", array(
            "label"         =>  "Időpont",
            "with_seconds"  =>  false,
            "date_format"   =>  \IntlDateFormatter::LONG,
            "constraints"   =>  array(
                new Assert\NotBlank(),
                new Assert\DateTime(),
            ),
        ));

        $builder->add("helyszin", "text", array(
            "label"         =>  "Helyszín",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("nyilvanos", "checkbox", array(
            "label"         =>  "Nyilvános",
        ));

        $builder->add("meghivottak", "entity", array(
            "label"         =>  "Meghívottak",
            "class"         =>  "SzakdolgozatFelhasznaloBundle:Felhasznalo",
            "expanded"      =>  true,
            "multiple"      =>  true,
        ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            "data_class"    =>  "Szakdolgozat\\UlesBundle\\Entity\\Ules",
        ));
    }


    public function getName()
    {
        return "ules";
    }
}
