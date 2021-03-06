<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPReview\AdminBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use PHPReview\WebsiteBundle\Classe\Gravatar as Gravatar;
use Symfony\Component\Security\Core\Encoder\EncoderFactory as EncoderFactory;

/**
 * PHPReview\WebsiteBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity(fields = "ds_email",message = "Este E-mail ja esta sendo utilizado.")
 */
class Usuario extends Gravatar implements UserInterface, \Serializable
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nm_usuario
     *
     * @ORM\Column(name="nm_usuario", type="string", length=200)
     * @Assert\NotBlank(message="O nome do usuário não pode ficar em branco")
     */
    private $nm_usuario;

    /**
     * @var string $ds_email
     *
     * @ORM\Column(name="ds_email", type="string", length=150)
     * @Assert\NotBlank(message="O nome do usuário não pode ficar em branco")
     * @Assert\Email(message="O e-mail informado não é um e-mail válido",checkMX=true)
     */
    private $ds_email;

    /**
     * @var string $sexo
     *
     * @ORM\Column(name="sexo", type="string", length=1)
     * @Assert\NotBlank(message="O Sexo deve ser informado")
     * @Assert\Choice(choices={"M","F"},message="Informe o valor M ou F")
     */
    private $sexo;

    /**
     * @var string $ds_endereco
     *
     * @ORM\Column(name="ds_senha", type="string", length="150")
     * @Assert\NotBlank(message="Informe uma senha")
     */
    private $ds_senha;

    /**
     * @var string $ds_salt
     * 
     * @ORM\Column(name="ds_salt",type="string", length="100")
     */
    private $ds_salt;
    
    /**
     * @var datetime $dt_criacao
     *
     * @ORM\Column(name="dt_criacao", type="datetime")
     */
    private $dt_criacao;

    /**
     * @var datetime $dt_atualizacao
     *
     * @ORM\Column(name="dt_atualizacao", type="datetime")
     */
    private $dt_atualizacao;


    /**
     * @ORM\OneToMany(targetEntity="Noticia",mappedBy="usuario")
     */
    private $noticias;
    
    /**
     * @var string $role
     * 
     * @ORM\Column(name="ds_role",type="string",length=40) 
     */
    private $role;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Cargos",inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_cargo",referencedColumnName="id")
     */
    private $cargo;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Escolaridade",inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_escolaridade",referencedColumnName="id")
     */
    private $escolaridade;
    
    /**
     *
     * @var PHPReview\AdminBundle\Entity\Estados estados
     * @ORM\ManyToOne(targetEntity="PHPReview\AdminBundle\Entity\Estados",inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_estado",referencedColumnName="id")
     */
    private $estado;
    
    /**
     * @ORM\ManyToOne(targetEntity="ComoConheceu")
     * @ORM\JoinColumn(name="id_como_conheceu",referencedColumnName="id")
     */
    private $como_conheceu;
    
    /**
     *
     * @var string $ds_confirma_senha;
     */
    public $ds_confirma_senha;
    
    /**
     *
     * @var Gravatar $gravatar
     */
    private $gravatar;
    
    /**
     * @ORM\Column(name="in_ativo",type="boolean")
     * 
     * @var boolean $in_ativo 
     */
    private $in_ativo;
    
     /**
     * @var PHPReview\AdminBundle\Entity\Chave $chave
     * @ORM\OneToMany(targetEntity="PHPReview\AdminBundle\Entity\Chave",mappedBy="usuario")
     */
    private $chaves;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nm_usuario
     *
     * @param string $nmUsuario
     */
    public function setNmUsuario($nmUsuario)
    {
        $this->nm_usuario = $nmUsuario;
    }

    /**
     * Get nm_usuario
     *
     * @return string 
     */
    public function getNmUsuario()
    {
        return $this->nm_usuario;
    }

    /**
     * Set ds_email
     *
     * @param string $dsEmail
     */
    public function setDsEmail($dsEmail)
    {
        $this->ds_email = $dsEmail;
    }

    /**
     * Get ds_email
     *
     * @return string 
     */
    public function getDsEmail()
    {
        return $this->ds_email;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set dt_criacao
     *
     * @param datetime $dtCriacao
     */
    public function setDtCriacao(\Datetime $dtCriacao = null)
    {
        if (is_null($dtCriacao)){
            $this->dt_criacao = \DateTime::createFromFormat(\Datetime::ATOM, date(\Datetime::ATOM));
        }else{
            $this->dt_criacao = $dtCriacao; 
        }
    }

    /**
     * Get dt_criacao
     *
     * @return datetime 
     */
    public function getDtCriacao($formato = null)
    {
        if (!$formato){
           return $this->dt_criacao; 
        }else{
            return $this->dt_criacao->format($formato); 
        }
    }

    /**
     * Set dt_atualizacao
     *
     * @param datetime $dtAtualizacao
     */
    public function setDtAtualizacao(\Datetime $dtAtualizacao = null)
    {
      if (is_null($dtAtualizacao)){
          $this->dt_atualizacao = \DateTime::createFromFormat(\Datetime::ATOM, date(\Datetime::ATOM));
      }else{   
       $this->dt_atualizacao = $dtAtualizacao;
      }
    }

    /**
     * Get dt_atualizacao
     *
     * @return datetime 
     */
    public function getDtAtualizacao($formato = null)
    {
        if ($formato){
            return $this->dt_atualizacao->format($formato);
        }else{
            return $this->dt_atualizacao;
        }
    }
    public function __construct()
    {
        $this->noticias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add noticias
     *
     * @param PHPReview\WebsiteBundle\Entity\Noticia $noticias
     */
    public function addNoticias(\PHPReview\WebsiteBundle\Entity\Noticia $noticias)
    {
        $this->noticias[] = $noticias;
    }

    /**
     * Get noticias
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNoticias()
    {
        return $this->noticias;
    }

    /**
     * Set cargo
     *
     * @param PHPReview\WebsiteBundle\Entity\Cargos $cargo
     */
    public function setCargo(\PHPReview\WebsiteBundle\Entity\Cargos $cargo)
    {
        $this->cargo = $cargo;
    }

    /**
     * Get cargo
     *
     * @return PHPReview\WebsiteBundle\Entity\Cargos 
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set escolaridade
     *
     * @param PHPReview\WebsiteBundle\Entity\Escolaridade $escolaridade
     */
    public function setEscolaridade(\PHPReview\WebsiteBundle\Entity\Escolaridade $escolaridade)
    {
        $this->escolaridade = $escolaridade;
    }

    /**
     * Get escolaridade
     *
     * @return PHPReview\WebsiteBundle\Entity\Escolaridade 
     */
    public function getEscolaridade()
    {
        return $this->escolaridade;
    }

    /**
     * Set estado
     *
     * @param PHPReview\AdminBundle\Entity\Estados $estado
     */
    public function setEstado(\PHPReview\AdminBundle\Entity\Estados $estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get estado
     *
     * @return PHPReview\AdminBundle\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set como_conheceu
     *
     * @param PHPReview\WebsiteBundle\Entity\ComoConheceu $comoConheceu
     */
    public function setComoConheceu(\PHPReview\WebsiteBundle\Entity\ComoConheceu $comoConheceu)
    {
        $this->como_conheceu = $comoConheceu;
    }

    /**
     * Get como_conheceu
     *
     * @return PHPReview\WebsiteBundle\Entity\ComoConheceu 
     */
    public function getComoConheceu()
    {
        return $this->como_conheceu;
    }
    
    /**
     * Define a regra básica para o usuário.
     * @param string $regra 
     */
    public function setRole($regra){
        $this->role = $regra;
    }
    
    /**
     * Retorna as regras que o usuário pertence.
     * 
     * @return array $regras
     */
    public function getRoles(){
        return array($this->role);
    }
    
    /**
     * Retorna o validador da senha do usuário.
     * Caso o usuário não possua validador e seja usuário novo, 
     * então um novo salt será criado.
     * 
    */
    public function getSalt(){
       return $this->ds_salt;
    }
    
    /**
     * Define a string de validação do usuário.
     * 
     * @param string $salt
     */
    public function setSalt($salt){
        $this->ds_salt = base64_encode($salt);
    }
    
    /**
     * Retorna o login do usuário.
     * 
     * @return string
     */
    public function getUsername(){
        return $this->ds_email;
    }
    
    /**
     * Remove credenciais antigas.
     */
    public function eraseCredentials(){
        $this->role = "";
    }
    
    /**
     * Valida se um usuário é igual ao outro.
     * 
     * @param UserInterface $user
     * @return string
     */
    public function equals(UserInterface $user){
        return $user->getId() == $this->getId();
    }
    
    /**
     * Define uma senha para o usuário.
     * @param type $senha 
     */
    public function setPassword($senha){
        $this->ds_senha = $senha;
    }
    
    /**
     * Recupera a senha do usuário
     * @return string 
     */
    public function getPassword(){
        return $this->ds_senha;
    }
    
    /**
     * Override para definir a senha do usuário.
     * @param string $senha 
     */
    public function setDsSenha($senha){
        $this->ds_senha = $senha;
    }
    
    /**
     * Override para recuperar a senha do usuário.
     */
    public function getDsSenha(){
        return $this->ds_senha;
    }
    
    /**
     * Método para criptografar a senha do usuário. 
     * Somente será chamada se a senha for válida.
     * 
     * @param type $factory 
     */
    public function criptografaSenha(EncoderFactory $factory){
        $encoder = $factory->getEncoder($this);
        $this->setSalt(date('Ymdhis'));
        $this->setDsSenha($encoder->encodePassword($this->getDsSenha(), $this->getSalt()));
    }
    
    /**
     * Valida se a senha e a confirmação de senha são iguais.
     * 
     * @Assert\True(message="Informe a senha e a confirmação iguais")
     */
    public function isSenhaValida(){
        return $this->ds_senha == $this->ds_confirma_senha;
    }
    
    /**
     *
     * @return type 
     */
    public function serialize()
    {
       return serialize($this->getId());
    }

    /**
     *
     * @param type $data 
     */
    public function unserialize($data)
    {
       $this->id = unserialize($data);
    }
    
    public function getInAtivo(){
        return $this->in_ativo;
    }
    
    public function setInAtivo($ativo){
        if (!is_bool($ativo)){
            throw new \Symfony\Component\Validator\Exception\ValidatorException('O campo deve ser booleano');
        }
        $this->in_ativo = $ativo;
    }


    /**
     * Set ds_salt
     *
     * @param string $dsSalt
     */
    public function setDsSalt($dsSalt)
    {
        $this->ds_salt = $dsSalt;
    }

    /**
     * Get ds_salt
     *
     * @return string 
     */
    public function getDsSalt()
    {
        return $this->ds_salt;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add noticias
     *
     * @param PHPReview\WebsiteBundle\Entity\Noticia $noticias
     */
    public function addNoticia(\PHPReview\WebsiteBundle\Entity\Noticia $noticias)
    {
        $this->noticias[] = $noticias;
    }

    /**
     * Add chaves
     *
     * @param PHPReview\AdminBundle\Entity\Chave $chaves
     */
    public function addChave(\PHPReview\AdminBundle\Entity\Chave $chaves)
    {
        $this->chaves[] = $chaves;
    }

    /**
     * Get chaves
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChaves()
    {
        return $this->chaves;
    }
    
    public function getListaRoles(){
        $a = array(array('value'=>'ROLE_USER','text'=> 'Assinante'), array('value'=>'ROLE_SUPER_USER', 'text'=>'Usuário membro'), array('value'=> 'ROLE_ADMIN','text'=>'Administrador'), array('value'=>'ROLE_SUPER_ADMIN','text'=> 'Super Administrador'));
        return $a;
    }
}