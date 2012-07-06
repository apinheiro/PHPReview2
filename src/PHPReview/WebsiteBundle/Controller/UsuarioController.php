<?php

namespace PHPReview\WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use PHPReview\WebsiteBundle\Form;
use PHPReview\WebsiteBundle\Entity\Usuario as Usuario;
use PHPReview\AdminBundle\Entity\Chave as Chave;
use PHPReview\AdminBundle\Entity\TipoChave as TipoChave;


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

              $chave = $this->geraChave($usuario, $em, TipoChave::CONFIRMAR_CADASTRO);

              $em->persist($usuario);
              $em->persist($chave);
              $em->flush();
              
              $this->enviaEmailConfirmacao($chave, $usuario);
              
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
     * Recuperar Senha
     * 
     * Método para o usuário informar o seu e-mail para recuperar a senha.
     * 
     * @Template() 
     */
    public function recuperaSenhaAction(){
       $request = $this->getRequest();
       
       if ($request->getMethod() == 'POST'){
           $email = $request->request->get('email');
           
           $em = $this->getDoctrine()->getEntityManager();
           $usuario = $em->getRepository('WebsiteBundle:Usuario')->findOneByDsEmail($email);
           
           $chave = $this->geraChave($usuario, $em, TipoChave::CONFIRMAR_CADASTRO);
           
           $this->persist($chave);
           $this->flush();
           
           // aqui envia o e-mail pro usuario.
           $this->enviaEmailConfirmacao($chave, $usuario);
           
           $this->get('session')->setFlash('notice','Foi enviado um e-mail com um código para você revalidar a sua senha.');
           return $this->redirect($this->generateUrl('validar_chave_usuario2'));
       }
       return array();
    }
    
    /**
     * @Template() 
     */
   public function novaSenhaAction($token = null){
       // somente quem informar o token que poderá acessar esta página.
       if (is_null($token)){
          return $this->redirect($this->generateUrl('homepage'));
       }
       
       $em = $this->getDoctrine()->getEntityManager();
       $chave = $em->getRepository('AdminBundle:Chave')->findOneByChave($token);
       
       if (!$chave){
          return $this->redirect($this->generateUrl('homepage')); 
       }
       
       if ($chave->getInExpirado() || $chave->getInUsado()){
           return $this->redirect($this->generateUrl('validar_chave_usuario2'));
       }
       
       $usuario = new Usuario();
       $usuario = $chave->getUsuario();
       
       // Se o usuário submeteu o formulário, entao devemos processar a senha.
       if ($this->getRequest()->getMethod() == 'POST' ){
           $senha = $this->getRequest()->request->get('senha');
           $usuario->setDsSenha($senha);
           $usuario->criptografaSenha($this->get('security.encoder_factory'));
           $usuario->setDtAtualizacao(\DateTime::createFromFormat(\Datetime::ATOM, date(\Datetime::ATOM)));
           
           $chave->setInUsado(true);
           
           $em->flush();
           return $this->render('WebsiteBundle:Usuario:sucesso.html.twig',array('sucesso'=>1));
       }
       return array('usuario'=>$usuario,'token'=>$token);
   }
    
    /**
     * Processa o token do usuário.
     * 
     * Recebe o token e processa o mesmo
     * @param string $token
     * @Template
     */
    public function validaCadastroAction($token = null){
        // Se o token não foi informado, verificar se veio por POST
        $_token = $token;
        
        if (is_null($_token)){
          $request = $this->getRequest();
          if ($request->getMethod() == "POST"){
              $_token = $request->request->get('token');
          }else{
             return array('sucesso'=>0);   
          }
        }
        
        $em = $this->getDoctrine()->getEntityManager();
        $chave = $em->getRepository('AdminBundle:Chave')->findOneByChave($_token);
        
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
        if ($chave->getTipoChave()->getId() == TipoChave::NOVA_SENHA){
            return $this->redirect(
                       $this->generateUrl('recuperar_senha_usuario_form',
                                          array('token'=>$_token)));
        }
        
        $usuario = $em->getRepository('WebsiteBundle:Usuario')->find($chave->getUsuario()->getId());
        $usuario->setInAtivo(true);
        $chave->setInUsado(true);
        $em->flush();
        
        return array('sucesso'=>1);
    }
    
    private function geraChave($usuario, $em, $tipo_chave ){
        $chave = new Chave();
        $chave->setChave(Chave::generateChave());
        $chave->setDataExpira(\DateTime::createFromFormat('d/m/Y H:i:s', date('d/m/Y H:i:s',strtotime("+3 days"))));
        $chave->setDataRegistro(new \DateTime());
        $chave->setInUsado(false);
        $chave->setInExpirado(false);
        $chave->setTipoChave($em->getRepository('AdminBundle:TipoChave')->find($tipo_chave));
        $chave->setUsuario($usuario);
        
        return $chave;
    }
    
    private function enviaEmailConfirmacao($chave, $usuario){
       $email = \Swift_Message::newInstance()
               ->setSubject('Confirmação de cadastro')
               ->setFrom('contato@phpreview.br')
               ->setTo($usuario->getDsEmail())
               ->setBody($this->renderView('WebsiteBundle:Emails:confirm.html.twig',array('chave'=>$chave)));
       $this->get('mailer')->send($email);
   }
}