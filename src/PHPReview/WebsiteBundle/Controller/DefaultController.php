<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('WebsiteBundle:Default:index.html.twig');
    }
    
     public function loginAction()
    {
        return $this->render('WebsiteBundle:Default:index.html.twig');
    }
    
}
