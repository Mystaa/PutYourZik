<?php

namespace PutYourZikBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('PutYourZikBundle:Default:index.html.twig');
    }
}
