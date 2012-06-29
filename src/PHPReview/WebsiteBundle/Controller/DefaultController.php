<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\SecurityContext;
use PHPReview\WebsiteBundle\Form\LoginType;

class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('WebsiteBundle:Default:index.html.twig');
    }
    
    /**
     * @Template()
     * @return type 
     */
     public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        
        $formulario = $this->createForm(new LoginType());
        return array('form'=>$formulario->createView(),'error'=>$error);
    }
    
}
