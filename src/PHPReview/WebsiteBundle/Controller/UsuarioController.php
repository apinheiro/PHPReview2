<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use PHPReview\WebsiteBundle\Form;
use PHPReview\WebsiteBundle\Entity\Usuario as Usuario;
use PHPReview\AdminBundle\Entity\Chave as Chave;

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
              $usuario->setInAtivo(false);

              $chave = new Chave();
              $chave->setChave(Chave::generateChave());
              $chave->setDataExpira(\DateTime::createFromFormat('d/m/Y H:i:s', date('d/m/Y H:i:s',strtotime("+3 days"))));
              $chave->setDataRegistro(new \DateTime());
              $chave->setInUsado(false);
              $chave->setInExpirado(false);
              $chave->setTipoChave($em->getRepository('AdminBundle:TipoChave')->find(1));
              $chave->setUsuario($usuario);

              $em->persist($usuario);
              $em->persist($chave);
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
    
    /**
     * @Template()
     * @return type 
     */
    public function getContagemAction(){
        
      $qb = $this->getDoctrine()->getEntityManager()->createQueryBuilder();
      $qb->select('count(u.id)');
      $qb->from('WebsiteBundle:Usuario','u');
      $qb->where('u.in_ativo = 1');

       $count = $qb->getQuery()->getSingleScalarResult();
       return array('total'=>$count);
    }
    
    /**
     * Processa o token do usuário.
     * 
     * Recebe o token e processa o mesmo
     * @param string $token
     * @Template
     */
    public function validaCadastroAction($token = null){
        
        $token = str_replace('token=', '', $token);
        
        if (empty($token)){
          return array('sucesso'=>0);   
        }
        
        $valido = false;
        // Correção para a tela de validação do usuario.
        
        
        $em = $this->getDoctrine()->getEntityManager();
        $chave = $em->getRepository('AdminBundle:Chave')->findOneByChave($token);
        
        // verificando se a chave existe
        if (!$chave){
            $this->get('session')->setFlash('error', 'A chave informada não existe!');
            return array('sucesso'=>0);
        }
        
        // Validando se o token está ativo.
        if ($chave->getInUsado() or $chave->getInExpirado()){
           $this->get('session')->setFlash('error', 'A chave informada não está válida!');
           return array('sucesso'=>0);
        }
        
        // Verificando se a chave está expirada.
        if ($chave->getDataExpira() < \DateTime::createFromFormat(\DateTime::ATOM, date(\DateTime::ATOM))){
            $this->get('session')->setFlash('error', 'A chave informada está expirada!');
            $chave->setInExpirado(true);
            $em->flush();
            return array('sucesso'=>0);
        }

        // Habilitando o usuário
        $usuario = $em->getRepository('WebsiteBundle:Usuario')->find($chave->getUsuario()->getId());
        $usuario->setInAtivo(true);
        $chave->setInUsado(true);
        $em->flush();
        
        return array('sucesso'=>1);
    }
}