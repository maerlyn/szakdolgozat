<?php

namespace Szakdolgozat\JegyzokonyvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Szakdolgozat\JegyzokonyvBundle\Form\JegyzokonyvType;

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
            "form"  =>  $form->createView(),
        ));
    }
}
