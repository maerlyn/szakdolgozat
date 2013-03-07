<?php

namespace Szakdolgozat\SzakdolgozatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SzakdolgozatSzakdolgozatBundle:Default:index.html.twig');
    }
}
