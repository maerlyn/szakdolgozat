<?php

namespace Szakdolgozat\JegyzokonyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class JegyzokonyvController extends Controller
{
    public function indexAction()
    {
        return $this->render('SzakdolgozatJegyzokonyBundle:Jegyzokonyv:index.html.twig');
    }
}
