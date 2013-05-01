<?php

namespace Szakdolgozat\JegyzokonyvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv;
use Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvFelszolalas;
use Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvNapirendiPont;
use Szakdolgozat\JegyzokonyvBundle\Entity\JegyzokonyvSzavazas;
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

    public function newGetAction()
    {
        $form = $this->createForm(new JegyzokonyvType());

        return $this->render("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:new.html.twig", array(
            "form"      =>  $form->createView(),
            "templatek" =>  $this->elemTemplatek(),
        ));
    }

    public function newPostAction(Request $request)
    {
        $jegyzokonyv = new Jegyzokonyv();
        $jegyzokonyv_form = $this->createForm(new JegyzokonyvType(), $jegyzokonyv);

        $jegyzokonyv_form->bind($request);

        $request_elemek = $request->request->get("elemek", array());
        $elemek = array();
        $minden_elem_valid = true;
        $kovetkezo_elem = 0;

        foreach ($request_elemek as $k => $request_elem) {
            switch ($request_elem["tipus"]) {
                case "felszolalas":   $form = $this->createForm(new FelszolalasType());   break;
                case "napirendipont": $form = $this->createForm(new NapirendiPontType()); break;
                case "szavazas":      $form = $this->createForm(new SzavazasType());      break;
            }

            $form->bind($request_elem);

            $elemek[] = array(
                "id"    =>  $k,
                "tipus" =>  $request_elem["tipus"],
                "form"  =>  $form,
            );
            $minden_elem_valid &= $form->isValid();
            if ($kovetkezo_elem > $k) $kovetkezo_elem = $k;
        }

        if ($minden_elem_valid && $jegyzokonyv_form->isValid()) {
            $jegyzokonyv->setJegyzokonyviro($this->getUser());
            $pozicio = 1;
            $em = $this->getDoctrine()->getManager();

            foreach ($elemek as $elem) {
                if ($elem["tipus"] === "felszolalas") {
                    $obj = new JegyzokonyvFelszolalas();
                }
                elseif ($elem["tipus"] === "napirendipont") {
                    $obj = new JegyzokonyvNapirendiPont();
                }
                elseif ($elem["tipus"] === "szavazas") {
                    $obj = new JegyzokonyvSzavazas();
                }

                $data = $elem["form"]->getData();
                $obj->fromArray($data);
                $obj->setPozicio($pozicio++);

                $obj->setJegyzokonyv($jegyzokonyv);
                $em->persist($obj);
                $jegyzokonyv->addElemek($obj);
            }

            $em->persist($jegyzokonyv);
            $em->flush();
            
            return $this->redirect($this->generateUrl("szakdolgozat_jegyzokonyv_jegyzokonyv_index"));
        }

        // invalid valami, ujra mutatni a formot

        foreach ($elemek as $k => $v) {
            $elemek[$k]["form"] = $v["form"]->createView();
        }

        return $this->render("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:new.html.twig", array(
            "form"              =>  $jegyzokonyv_form->createView(),
            "elemek"            =>  $elemek,
            "kovetkezo_elem"    =>  $kovetkezo_elem,
            "templatek"         =>  $this->elemTemplatek(),
        ));
    }

    public function editAction(Jegyzokonyv $jegyzokonyv, Request $request)
    {
        if ($jegyzokonyv->getLezarva()) {
            throw new NotFoundHttpException();
        }

        $jegyzokonyv_form = $this->createForm(new JegyzokonyvType(), $jegyzokonyv);
        $elemek = array();

        foreach ($jegyzokonyv->getElemek() as $elem) {
            if ($elem instanceof JegyzokonyvFelszolalas) {
                $tipus = "felszolalas";
                $form  = $this->createForm(new FelszolalasType(), $elem);
            }
            elseif ($elem instanceof JegyzokonyvNapirendiPont) {
                $tipus = "napirendipont";
                $form  = $this->createForm(new NapirendiPontType(), $elem);
            }
            else {
                $tipus = "szavazas";
                $form  = $this->createForm(new SzavazasType(), $elem);
            }

            $elemek[] = array(
                "id"    =>  $elem->getId(),
                "tipus" =>  $tipus,
                "form"  =>  $form,
            );
        }

        if ($request->isMethod("post")) {
            $jegyzokonyv_form->bind($request);

            $request_elemek = $request->request->get("elemek", array());
            $elemek = array();
            $minden_elem_valid = true;
            $kovetkezo_elem = 0;

            foreach ($request_elemek as $k => $request_elem) {
                if ($k < 0) { // uj elem
                    switch ($request_elem["tipus"]) {
                        case "felszolalas":   $form = $this->createForm(new FelszolalasType());   break;
                        case "napirendipont": $form = $this->createForm(new NapirendiPontType()); break;
                        case "szavazas":      $form = $this->createForm(new SzavazasType());      break;
                    }
                } else { // letezo elem
                    switch ($request_elem["tipus"]) {
                        case "felszolalas":
                            $obj = $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvFelszolalas")->find($k);
                            $form = $this->createForm(new FelszolalasType(), $obj);
                            break;
                        case "napirendipont":
                            $obj = $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvNapirendiPont")->find($k);
                            $form = $this->createForm(new NapirendiPontType(), $obj);
                            break;
                        case "szavazas":
                            $obj = $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvSzavazas")->find($k);
                            $form = $this->createForm(new SzavazasType(), $obj);
                            break;
                    }
                }

                // tehat megvannak a formjaink
                $form->bind($request_elem);

                $elemek[] = array(
                    "id"    =>  $k,
                    "tipus" =>  $request_elem["tipus"],
                    "form"  =>  $form,
                );

                $minden_elem_valid &= $form->isValid();
                if ($kovetkezo_elem > $k) $kovetkezo_elem = $k;
            }

            if ($minden_elem_valid && $jegyzokonyv_form->isValid()) {
                $pozicio = 1;
                $em = $this->getDoctrine()->getManager();
                $jegyzokonyv->clearElemek();

                foreach ($elemek as $elem) {
                    switch ($elem["tipus"]) {
                        case "felszolalas":
                            $obj = $elem["id"] < 0
                                ? new JegyzokonyvFelszolalas()
                                : $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvFelszolalas")->find($elem["id"]);
                            break;
                        case "napirendipont":
                            $obj = $elem["id"] < 0
                                ? new JegyzokonyvNapirendiPont()
                                : $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvNapirendiPont")->find($elem["id"]);
                            break;
                        case "szavazas":
                            $obj = $elem["id"] < 0
                                ? new JegyzokonyvSzavazas()
                                : $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvSzavazas")->find($elem["id"]);
                            break;
                    }

                    $data = $elem["form"]->getData();
                    if (is_array($data)) $obj->fromArray($data);
                    $obj->setPozicio($pozicio++);

                    $obj->setJegyzokonyv($jegyzokonyv);
                    $em->persist($obj);
                    $jegyzokonyv->addElemek($obj);
                }

                // torlendoek torlese
                $torolt_elemek = $request->request->get("toroltelemek", array());
                foreach ($torolt_elemek as $torolt_elem_id) {
                    $obj = $this->getDoctrine()->getRepository("SzakdolgozatJegyzokonyvBundle:JegyzokonyvElem")->find($torolt_elem_id);
                    $em->remove($obj);
                }

                $em->persist($jegyzokonyv);
                $em->flush();

                return $this->redirect($this->generateUrl("szakdolgozat_jegyzokonyv_jegyzokonyv_index"));
            }
        }

        // valami nem stimm, ujra mutatjuk a templatet

        foreach ($elemek as $k => $v) {
            $elemek[$k]["form"] = $v["form"]->createView();
        }

        return $this->render("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:edit.html.twig", array(
            "form"      =>  $jegyzokonyv_form->createView(),
            "elemek"    =>  $elemek,
            "templatek" =>  $this->elemTemplatek(),
            "torolt_elemek" =>  $request->request->get("toroltelemek", array()),
        ));
    }

    public function pdfAction(Jegyzokonyv $jegyzokonyv)
    {
        $exporter = $this->get("szakdolgozat.jegyzokonyv.export.pdf");

        $exporter->jegyzokonyv($jegyzokonyv);
        //az elozo sor visszaadja a usernek
        die();
    }

    public function showAction(Jegyzokonyv $jegyzokonyv)
    {
        return $this->render("SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:show.html.twig", array(
            "jegyzokonyv"   =>  $jegyzokonyv,
        ));
    }

    public function lezarasifolyamatAction(Jegyzokonyv $jegyzokonyv, Request $request)
    {
        if (
            $request->request->has("lezaras") &&
            !$jegyzokonyv->getLezarva() &&
            $jegyzokonyv->getJegyzokonyviro() == $this->getUser()
        ) {
            $jegyzokonyv->setLezarva(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
        }

        if (
            $request->request->has("hitelesites") &&
            (
                (
                    !$jegyzokonyv->getHitelesitve1() &&
                    $jegyzokonyv->getHitelesito1() == $this->getUser()
                ) ||
                (
                    !$jegyzokonyv->getHitelesitve2() &&
                    $jegyzokonyv->getHitelesito2() == $this->getUser()
                )
            )
        ) {
            if ($jegyzokonyv->getHitelesito1() == $this->getUser()) {
                $jegyzokonyv->setHitelesitve1(new \DateTime());
            } else {
                $jegyzokonyv->setHitelesitve2(new \DateTime());
            }

            $this->getDoctrine()->getManager()->flush();
        }

        return $this->redirect($this->generateUrl("szakdolgozat_jegyzokonyv_jegyzokonyv_show", array("id" => $jegyzokonyv->getId())));
    }

    protected function elemTemplatek()
    {
        return array(
            "felszolalas"   =>  $this->createForm(new FelszolalasType())->createView(),
            "napirendipont" =>  $this->createForm(new NapirendiPontType())->createView(),
            "szavazas"      =>  $this->createForm(new SzavazasType())->createView(),
        );
    }
}
