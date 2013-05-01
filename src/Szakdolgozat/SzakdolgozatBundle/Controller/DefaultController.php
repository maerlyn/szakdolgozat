<?php

namespace Szakdolgozat\SzakdolgozatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $ulesRepository         = $this->getDoctrine()->getRepository("SzakdolgozatUlesBundle:Ules");
        $jegyzokonyvRepository  = $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv");

        $kovetkezoUleseim           = $ulesRepository->kovetkezoUleseim($this->getUser());
        $jegyzokonyvNelkuliUleseim  = $ulesRepository->jegyzokonyvNelkuliUleseim($this->getUser());

        $lezaratlanJegyzokonyveim           = $jegyzokonyvRepository->lezaratlanJegyzokonyveim($this->getUser());
        $hitelesitesreVaroJegyzokonyveim    =   $jegyzokonyvRepository->hitelesitesreVaroJegyzokonyveim($this->getUser());

        return $this->render('SzakdolgozatSzakdolgozatBundle:Default:index.html.twig', array(
            "kovetkezoUleseim"                  =>  $kovetkezoUleseim,
            "jegyzokonyvNelkuliUleseim"         =>  $jegyzokonyvNelkuliUleseim,
            "lezaratlanJegyzokonyveim"          =>  $lezaratlanJegyzokonyveim,
            "hitelesitesreVaroJegyzokonyveim"   =>  $hitelesitesreVaroJegyzokonyveim,
        ));
    }
}
