<?php

namespace PHPReview\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;


/**
 * @Route("") 
 */
class DefaultController extends Controller
{
    /**
    * @Route("")
    */
    public function indexAction()
    {
        return $this->render('AdminBundle:Default:index.html.twig', array('name' => ''));
    }
}
