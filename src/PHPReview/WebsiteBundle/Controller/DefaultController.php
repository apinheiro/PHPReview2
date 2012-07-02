<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\SecurityContext;
use PHPReview\WebsiteBundle\Form\LoginType;
use PHPReview\WebsiteBundle\Entity\Usuario;

class DefaultController extends Controller
{
    
    /**
     * @Template()
     * @return type 
     */
    public function indexAction()
    {
        
       $usuario = $this->getDoctrine()->getRepository('WebsiteBundle:Usuario')->find(2);
        
       $enc = $this->get('security.encoder_factory');
       $senha = $enc->getEncoder($usuario)->encodePassword('PHPReview123',$usuario->getSalt());
        return array('senha_original'=>$usuario->getPassword(). " - ". $usuario->getSalt(),'senha_calculada'=>$senha);
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
