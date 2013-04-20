<?php

namespace Szakdolgozat\JegyzokonyvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function newPostAction(Request $request, Jegyzokonyv $jegyzokonyv = null)
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
        var_dump($jegyzokonyv->getElemek());
        die();
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
