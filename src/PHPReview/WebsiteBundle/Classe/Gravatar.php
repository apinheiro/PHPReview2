<?php
 namespace PHPReview\WebsiteBundle\Classe;
 
 class Gravatar {
     
     /**
      * URL do Gravatar
      * 
      * Informa qual a url que deve ser usada para acessar a imagem do gravatar.
      * @var String $url
      */
     private $url = "http://www.gravatar.com/avatar/";
     
     /**
      * Imagem Alternativa
      * 
      * Caso o e-mail informado não conste no gravatar, esta deve ser a imagem alternativa
      * apresentada pelo site.
      * 
      * @var string $url_imagem_alternativa
      */
     private $url_imagem_alternativa = "http://www.phpreview.br:8080/bundles/admin/images/usuario.png";
     
     /**
      * E-mail do usuário
      * 
      * informado no momento da geração da imagem.
      * 
      * @var string $email
      */
     private $email;
     
     /**
      *Largura da imagem
      * 
      * Largura no qual será apresentada a imagem.
      * @var integer $largura_imagem
      */
     private $largura_imagem = 64;
     
     public function __construct() {} 
     
     public function geraGravatar($email,$largura = null){
         $this->email = $email;
         if (!$largura) $this->largura_imagem = $largura;
         
         $email_cripto = md5(strtolower(trim($this->email)));
         
         $retorno = $this->url . $email_cripto;
         $retorno .= "?d=".urlencode($this->url_imagem_alternativa);
         $retorno .= "&s=". $this->largura_imagem. "&r=g";
         
         return $retorno;
     }
     
 }
?>
