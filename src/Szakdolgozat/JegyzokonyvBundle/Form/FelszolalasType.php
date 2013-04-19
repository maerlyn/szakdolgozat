<?php

namespace Szakdolgozat\JegyzokonyvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FelszolalasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("szoveg", "textarea", array(
            "label"         =>  "Szöveg",
            "constraints"   =>  new Assert\NotBlank(),
        ));
    }

    public function getName()
    {
        return "felszolalas";
    }
}
