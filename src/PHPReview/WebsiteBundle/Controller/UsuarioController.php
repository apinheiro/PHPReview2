<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use PHPReview\WebsiteBundle\Form;
use PHPReview\WebsiteBundle\Entity\Usuario as Usuario;

class UsuarioController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('WebsiteBundle:Default:index.html.twig', array('name' => $name));
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
            $form->bindRequest($request);
            
            if($form->isValid()){
              
              $usuario->criptografaSenha($this->get('security.encoder_factory'));
              $usuario->setRole('ROLE_USER');
              $usuario->setDtCriacao(date('Y-m-d H:i:s'));
              
              $em = $this->getDoctrine()->getEntityManager();
              $em->persist($usuario);
              $em->flush();

              $this->get('session')->setFlash('notice', 'Usuario criado com sucesso!');
              return $this->redirect($this->generateUrl('homepage_cadastro_sucesso'));   
            }
        }else{
            return array('form'=>$formulario->createView());
        }
        
    }
    
    /**
     * @Template()
     */
    public function sucessoAction(){
        
    }
}