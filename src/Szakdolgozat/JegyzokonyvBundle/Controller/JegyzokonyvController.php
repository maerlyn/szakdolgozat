<?php

namespace Szakdolgozat\JegyzokonyvBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JegyzokonyvController extends Controller
{
    public function indexAction()
    {
        return $this->render('SzakdolgozatJegyzokonyvBundle:Jegyzokonyv:index.html.twig');
    }
}
