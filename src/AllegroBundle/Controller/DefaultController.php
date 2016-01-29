<?php

namespace AllegroBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AllegroBundle:Default:index.html.twig');
    }
}
