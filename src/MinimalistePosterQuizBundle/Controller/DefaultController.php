<?php

namespace MinimalistePosterQuizBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $name = ", ceci est une page de test";
        return $this->render('MinimalistePosterQuizBundle:Default:index.html.twig', array('name' => $name));
    }
}
