<?php

namespace Szakdolgozat\UlesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Szakdolgozat\UlesBundle\Entity\Dokumentum;
use Szakdolgozat\UlesBundle\Entity\Ules;
use Szakdolgozat\UlesBundle\Form\DokumentumType;
use Szakdolgozat\UlesBundle\Form\UlesType;

class DokumentumController extends Controller
{
    public function newAction(Ules $ules, Request $request)
    {
        if ($ules->getFelhasznalo() != $this->getUser()) {
            throw new AccessDeniedHttpException();
        }

        $form = $this->createForm(new DokumentumType());
        $form->bind($request);

        if ($form->isValid()) {
            $dok = $form->getData();
            $dok->setUles($ules);

            $em = $this->getDoctrine()->getManager();
            $em->persist($dok);
            $em->flush();

            return $this->redirect($this->generateUrl("szakdolgozat_ules_ules_edit", array("id" => $ules->getId())));
        }

        return $this->render("SzakdolgozatUlesBundle:Ules:edit.html.twig", array(
            "form"              =>  $this->createForm(new UlesType())->createView(),
            "ules"              =>  $ules,
            "dokumentumform"    =>  $form->createView(),
        ));
    }

    public function downloadAction(Dokumentum $dokumentum)
    {
        $response = new Response();
        $response->setContent(file_get_contents($dokumentum->getFilename()));
        $response->headers->set("Content-Type", "application/octet-stream");
        $response->headers->set("Content-Disposition", "attachment; filename=" . $dokumentum->getEredetiFilenev());

        return $response;
    }
}
