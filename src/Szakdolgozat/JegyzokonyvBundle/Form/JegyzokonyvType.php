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

        $builder->add("ules_vege", "time", array(
            "label"         =>  "Ülés vége",
            "with_seconds"  =>  false,
            "constraints"   =>  array(
                new Assert\NotBlank(),
                new Assert\Time(),
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

        $builder->add("ules_hatarozatkepes", "checkbox", array(
            "label"         =>  "Az ülés határozatképes",
        ));

        $builder->add("szavazati_jogu_tagok_szama", "integer", array(
            "label"         =>  "Szavazati jogú tagok száma",
        ));

        $builder->add("jelen_levo_szavazati_joguak", "integer", array(
            "label"         =>  "Jelen levő szavazati jogú tagok száma",
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
