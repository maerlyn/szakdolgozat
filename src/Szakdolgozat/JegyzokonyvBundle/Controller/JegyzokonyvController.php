<?php

namespace Szakdolgozat\JegyzokonyvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Szakdolgozat\JegyzokonyvBundle\Form\FelszolalasType;
use Szakdolgozat\JegyzokonyvBundle\Form\NapirendiPontType;
use Szakdolgozat\JegyzokonyvBundle\Form\JegyzokonyvType;
use Szakdolgozat\JegyzokonyvBundle\Form\SzavazasType;

class JegyzokonyvController extends Controller
{
    public function indexAction()
    {
        $jegyzokonyvek = $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv")->findAll();

        return $this->render('SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:index.html.twig', array(
            "jegyzokonyvek" => $jegyzokonyvek,
        ));
    }

    public function newAction()
    {
        $form = $this->createForm(new JegyzokonyvType());

        return $this->render("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:new.html.twig", array(
            "form"      =>  $form->createView(),
            "templatek" =>  array(
                "felszolalas"   =>  $this->createForm(new FelszolalasType())->createView(),
                "napirendipont" =>  $this->createForm(new NapirendiPontType())->createView(),
                "szavazas"      =>  $this->createForm(new SzavazasType())->createView(),
            ),
        ));
    }
}
