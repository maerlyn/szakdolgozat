<?php

namespace Szakdolgozat\FelhasznaloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Szakdolgozat\FelhasznaloBundle\Entity\Felhasznalo;
use Szakdolgozat\FelhasznaloBundle\Form\Type\FelhasznaloType;

class FelhasznaloController extends Controller
{
    public function indexAction()
    {
        $szervezeti_egysegek = $this->getDoctrine()->getRepository("SzakdolgozatFelhasznaloBundle:SzervezetiEgyseg")->findAll();

        return $this->render("SzakdolgozatFelhasznaloBundle:Felhasznalo:index.html.twig", array(
            "szervezeti_egysegek"   =>  $szervezeti_egysegek,
        ));
    }

    public function newAction(Request $request)
    {
        $form = $this->createForm(new FelhasznaloType());

        if ($request->isMethod("post")) {
            $form->bind($request);

            if ($form->isValid()) {
                $data = $form->getData();
                $em = $this->getDoctrine()->getManager();

                $em->persist($data);
                $em->flush();

                return $this->redirect($this->generateUrl("szakdolgozat_felhasznalo_felhasznalo_index"));
            }
        }

        return $this->render("SzakdolgozatFelhasznaloBundle:Felhasznalo:new.html.twig", array(
            "form" => $form->createView(),
        ));
    }

    public function editAction(Felhasznalo $felhasznalo, Request $request)
    {
        $form = $this->createForm(new FelhasznaloType(), $felhasznalo);

        if ($request->isMethod("post")) {
            $form->bind($request);

            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirect($this->generateUrl("szakdolgozat_felhasznalo_felhasznalo_index"));
            }
        }

        return $this->render("SzakdolgozatFelhasznaloBundle:Felhasznalo:edit.html.twig", array(
            "form"          =>  $form->createView(),
            "felhasznalo"   =>  $felhasznalo,
        ));
    }
}
