<?php

namespace Szakdolgozat\JegyzokonyvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class JegyzokonyvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("nev", "text", array(
            "label"         =>  "Név",
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

        $builder->add("hitelesito_1", "entity", array(
            "label"         =>  "Hitelesítő 1",
            "class"         =>  "SzakdolgozatFelhasznaloBundle:Felhasznalo",
        ));

        $builder->add("hitelesito_2", "entity", array(
            "label"         =>  "Hitelesítő 2",
            "class"         =>  "SzakdolgozatFelhasznaloBundle:Felhasznalo",
        ));
    }


    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            "data_class" => 'Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv',
        ));
    }


    public function getName()
    {
        return "jegyzokonyv";
    }

}
