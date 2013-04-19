<?php

namespace Szakdolgozat\JegyzokonyvBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints as Assert;

class FelszolalasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("tipus", "hidden", array("data" => "felszolalas"));

        $builder->add("szoveg", "textarea", array(
            "label"         =>  "Szöveg",
            "constraints"   =>  new Assert\NotBlank(),
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
        return "felszolalas";
    }
}
