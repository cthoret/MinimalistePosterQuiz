<?php

namespace MinimalistePosterQuizBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function defaultAction()
    {
        return $this->render('MinimalistePosterQuizBundle:Admin/Default:default.html.twig');
    }
}
