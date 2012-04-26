<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('WebsiteBundle:Default:index.html.twig', array('name' => $name));
    }
}
