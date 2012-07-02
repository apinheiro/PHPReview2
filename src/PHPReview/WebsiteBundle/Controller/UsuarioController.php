<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use PHPReview\WebsiteBundle\Form;
use PHPReview\WebsiteBundle\Entity\Usuario as Usuario;

class UsuarioController extends Controller
{
    /**
     * @Template
     */
    public function indexAction()
    {
        return array('name' => $name);
    }
        
    /**
     * @Template()
     */
    public function cadastroAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = new Usuario();
        $request = $this->getRequest();
        
        $formulario = $this->createForm(new Form\UsuarioType(),$usuario);
        
        if ($request->getMethod() == "POST"){
            $formulario->bindRequest($request);
            
            if($formulario->isValid()){
              
              $usuario->criptografaSenha($this->get('security.encoder_factory'));
              $usuario->setRole('ROLE_USER');
              $usuario->setDtCriacao(\DateTime::createFromFormat(\Datetime::ATOM, date(\Datetime::ATOM)));
              $usuario->setDtAtualizacao(\DateTime::createFromFormat(\Datetime::ATOM, date(\Datetime::ATOM)));
              
              $em = $this->getDoctrine()->getEntityManager();
              $em->persist($usuario);
              $em->flush();

              $this->get('session')->setFlash('notice', 'Usuario criado com sucesso!');
              return $this->redirect($this->generateUrl('homepage_cadastro_sucesso'));   
            }
        }
        
        return array('form'=>$formulario->createView());
        
    }
    
    /**
     * @Template()
     */
    public function sucessoAction(){
        return array();
    }
    
    /**
     * @Template() 
     */
    public function recuperaSenhaAction(){
        
    }
}