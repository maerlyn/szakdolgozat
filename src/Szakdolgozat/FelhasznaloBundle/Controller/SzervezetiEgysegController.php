<?php

namespace Szakdolgozat\FelhasznaloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Szakdolgozat\FelhasznaloBundle\Entity\SzervezetiEgyseg;
use Szakdolgozat\FelhasznaloBundle\Form\Type\SzervezetiEgysegType;

class SzervezetiEgysegController extends Controller
{
    public function indexAction()
    {
        $szervezeti_egysegek = $this->getDoctrine()->getRepository("SzakdolgozatFelhasznaloBundle:SzervezetiEgyseg")->findAll();

        return $this->render("SzakdolgozatFelhasznaloBundle:SzervezetiEgyseg:index.html.twig", array(
            "szervezeti_egysegek" => $szervezeti_egysegek,
        ));
    }

    public function newAction(Request $request)
    {
        $form = $this->createForm(new SzervezetiEgysegType());

        if ($request->isMethod("post")) {
            $form->bind($request);

            if ($form->isValid()) {
                $sze = $form->getData();
                $em = $this->getDoctrine()->getManager();

                $em->persist($sze);
                $em->flush();

                return $this->redirect($this->generateUrl("szakdolgozat_felhasznalo_szervezetiegyseg_index"));
            }
        }

        return $this->render("SzakdolgozatFelhasznaloBundle:SzervezetiEgyseg:new.html.twig", array(
            "form"  =>  $form->createView(),
        ));
    }

    public function editAction(SzervezetiEgyseg $sze, Request $request)
    {
        $form = $this->createForm(new SzervezetiEgysegType(), $sze);

        if ($request->isMethod("post")) {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl("szakdolgozat_felhasznalo_szervezetiegyseg_index"));
            }
        }

        return $this->render("SzakdolgozatFelhasznaloBundle:SzervezetiEgyseg:edit.html.twig", array(
            "form"  =>  $form->createView(),
            "sze"   =>  $sze,
        ));
    }

    public function deleteAction(SzervezetiEgyseg $sze)
    {
        if (!count($sze->getFelhasznalok())) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sze);
            $em->flush();
        }

        return $this->redirect($this->generateUrl("szakdolgozat_felhasznalo_szervezetiegyseg_index"));
    }
}
