<?php

namespace Szakdolgozat\JegyzokonyvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class SzavazasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("cim", "text", array(
            "label"         =>  "Cím",
            "constraints"   =>  new Assert\NotBlank(),
        ));

        $builder->add("mellette", "integer", array(
            "label"         =>  "Mellette",
        ));

        $builder->add("ellene", "integer", array(
            "label"         =>  "Ellene",
        ));

        $builder->add("tartozkodott", "integer", array(
            "label"         =>  "Tartózkodott",
        ));

        $builder->add("ervenytelen", "integer", array(
            "label"         =>  "Érvénytelen",
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            "csrf_protection"   =>  false,
        ));
    }


    public function getName()
    {
        return "szavazas";
    }
}
