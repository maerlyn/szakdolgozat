<?php

namespace Szakdolgozat\UlesBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class DokumentumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("leiras", "text", array(
            "label"         =>  "Leírás",
            "constraints"   =>  array(
                new Assert\NotBlank(),
                new Assert\Length(array("max" => 255)),
            ),
        ));

        $builder->add("file", "file", array(
            "label"         =>  "File",
            "constraints"   =>  array(
                new Assert\NotBlank(),
                new Assert\File(),
            ),
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            "data_class"    =>  "Szakdolgozat\\UlesBundle\\Entity\\Dokumentum",
        ));
    }


    public function getName()
    {
        return "dokumentum";
    }
}
