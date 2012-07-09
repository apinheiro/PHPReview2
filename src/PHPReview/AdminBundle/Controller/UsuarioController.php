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
     * @Route("")
     * @param type $name 
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $usuarios = $em->createQuery('select u from WebsiteBundle:Usuario u');
        
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($usuarios);
        return compact('pagination');
    }
    
    /**
     * @Route("/{id}.{_format}",requirements={"id" = "\d+","_format"="html|htm|json"})
     * @Template()
     */
    public function showAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $em->getRepository('WebsiteBundle:Usuario')->find($id);
        
        return array('usuario'=>$usuario);
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
    public function editAction($id)
    {
        
    }
    
    /**
     *
     *@Route("/disable/{id}") 
     */
    public function desabilitaAction($id)
    {
        
    }
    
    /**
     * @Route("/remove/{id}")
     */
    public function removeAction($id)
    {
        
    }
    /**
     * @Template
     * @Route("/remove/atualiza_perfil_usuario.{_format}",requirements={"_format"="json"})
     * @Method({"POST"})
     */
    
    public function atualizaRegraAction(){
        try{
            $request = $this->getRequest();

            $em = $this->getDoctrine->getEntityManager();
            $usuario = $em->getRepository('WebsiteBundle:Usuario')->find($request->request->get('id'));

            $usuario->setRole($request->request->get('role'));
            $em->flush();
            
            return array('valido'=>'1','mensagem'=>$usuario->getRole());
        }catch(\Exception $ex){
            return array('valido'=>'0','mensagem'=> $ex->getMessage());
        }
        
    }
}

?>
