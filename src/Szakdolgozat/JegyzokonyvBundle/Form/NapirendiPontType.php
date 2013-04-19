<?php

namespace Szakdolgozat\JegyzokonyvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class NapirendiPontType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("cim", "text", array(
            "label"         =>  "Cím",
            "constraints"   =>  new Assert\NotBlank(),
        ));
    }


    public function getName()
    {
        return "napirendipont";
    }
}
