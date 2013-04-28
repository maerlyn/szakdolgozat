<?php

namespace Szakdolgozat\UlesBundle\Controller;

use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Szakdolgozat\UlesBundle\Entity\Ules;
use Szakdolgozat\UlesBundle\Event\GcalEvent;
use Szakdolgozat\UlesBundle\Form\DokumentumType;
use Szakdolgozat\UlesBundle\Form\UlesType;

class UlesController extends Controller
{
    public function indexAction()
    {
        $ulesek = $this->getDoctrine()->getRepository("SzakdolgozatUlesBundle:Ules")->findAll();

        return $this->render("SzakdolgozatUlesBundle:Ules:index.html.twig", array(
            "ulesek" => $ulesek,
        ));
    }

    /**
     * @Secure(roles="ROLE_ULESHIRDETO")
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(new UlesType());

        if ($request->isMethod("post")) {
            $form->bind($request);

            if ($form->isValid()) {
                $ules = $form->getData();
                $ules->setFelhasznalo($this->getUser());

                $em = $this->getDoctrine()->getManager();

                $em->persist($ules);
                $em->flush();

                $this->get("event_dispatcher")->dispatch("ules.new", new GcalEvent($ules));

                return $this->redirect($this->generateUrl("szakdolgozat_ules_ules_index"));
            }
        }

        return $this->render("SzakdolgozatUlesBundle:Ules:new.html.twig", array("form" => $form->createView()));
    }

    public function editAction(Ules $ules, Request $request)
    {
        if ($ules->getFelhasznalo() != $this->getUser()) {
            throw new AccessDeniedHttpException();
        }

        $form = $this->createForm(new UlesType(), $ules);

        if ($request->isMethod("post")) {
            $form->bind($request);

            if ($form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                $this->get("event_dispatcher")->dispatch("ules.edit", new GcalEvent($ules));

                return $this->redirect($this->generateUrl("szakdolgozat_ules_ules_index"));
            }
        }

        return $this->render("SzakdolgozatUlesBundle:Ules:edit.html.twig", array(
            "form"              =>  $form->createView(),
            "ules"              =>  $ules,
            "dokumentumform"    =>  $this->createForm(new DokumentumType())->createView(),
        ));
    }

    public function deleteAction(Ules $ules)
    {
        if ($ules->getFelhasznalo() != $this->getUser()) {
            throw new AccessDeniedHttpException();
        }

        $em = $this->getDoctrine()->getManager();

        foreach ($ules->getDokumentumok() as $dok) {
            $em->remove($dok);
        }

        $em->remove($ules);
        $em->flush();

        $this->get("event_dispatcher")->dispatch("ules.delete", new GcalEvent($ules));

        return $this->redirect($this->generateUrl("szakdolgozat_ules_ules_index"));
    }
}
