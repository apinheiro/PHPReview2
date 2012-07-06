<?php

namespace PHPReview\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use PHPReview\WebsiteBundle\Entity\Usuario as Usuario;

/**
 * @Route("/usuario")
 * 
 */
class UsuarioController extends Controller
{
    /**
     * @Template()
     * @Route("/")
     * @Secure(roles="ROLE_ADMIN")
     * @param type $name 
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $usuarios = $em->createQuery('select u from WebsiteBundle:Usuario u');
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query,
                $this->getRequest()->query->get('p',1),20
                );
        return array('usuarios'=>compact('pagination'));
    }
    
    /**
     * @Route("/new")
     */
      
    public function newAction()
    {
        
    }
    
    /**
     * @Route("/edit/{id}")
     */
    public function editAction()
    {
        
    }
    
    /**
     *
     *@Route("/disable/{id}") 
     */
    public function desabilitaAction()
    {
        
    }
    
    /**
     * @Route("/remove/{id}")
     */
    public function removeAction()
    {
        
    }
}

?>
