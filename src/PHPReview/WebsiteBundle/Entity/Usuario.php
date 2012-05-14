<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPReview\AdminBundle\Entity;

/**
 * PHPReview\WebsiteBundle\Entity\Usuario
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id_usuario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $nm_usuario
     *
     * @ORM\Column(name="nm_usuario", type="string", length=200)
     */
    private $nm_usuario;

    /**
     * @var string $ds_email
     *
     * @ORM\Column(name="ds_email", type="string", length=150)
     */
    private $ds_email;

    /**
     * @var string $sexo
     *
     * @ORM\Column(name="sexo", type="string", length=1)
     */
    private $sexo;

    /**
     * @var string $ds_endereco
     *
     * @ORM\Column(name="ds_endereco", type="string")
     */
    private $ds_endereco;

    /**
     * @var string $ds_complemento
     *
     * @ORM\Column(name="ds_complemento", type="string")
     */
    private $ds_complemento;

    /**
     * @var string $ds_numero
     *
     * @ORM\Column(name="ds_numero", type="string", length=50)
     */
    private $ds_numero;

    /**
     * @var integer $nr_cep
     *
     * @ORM\Column(name="nr_cep", type="integer")
     */
    private $nr_cep;

    /**
     * @var string $ds_bairro
     *
     * @ORM\Column(name="ds_bairro", type="string", length=80)
     */
    private $ds_bairro;

    /**
     * @var string $ds_cidade
     *
     * @ORM\Column(name="ds_cidade", type="string", length=50)
     */
    private $ds_cidade;

    /**
     * @var string $ds_como_conheceu
     *
     * @ORM\Column(name="ds_como_conheceu", type="string")
     */
    private $ds_como_conheceu;

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
     * @ORM\OneToMany(targetEntity="Noticias",mappedBy="usuario")
     */
    private $noticias;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Cargos",inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_cargo",referencedColumnName="id_cargo")
     */
    private $cargo;
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="Escolaridade",inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_escolaridade",referencedColumnName="id_escolaridade")
     */
    private $escolaridade;
    
    /**
     *
     * @var PHPReview\AdminBundle\Estado
     * @ORM\ManyToOne(targetEntity="PHPReview\AdminBundle\Estado",inversedBy="usuarios")
     * @ORM\JoinColumn(name="id_estado",referencedColumnName="id_estado")
     */
    private $estado;
    
    /**
     * @ORM\ManyToOne(targetEntity="ComoConheceu")
     * @ORM\JoinColumn(name="id_como_conheceu",referencedColumnName="id_como_conheceu")
     */
    private $como_conheceu;
    
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
     * Set ds_endereco
     *
     * @param string $dsEndereco
     */
    public function setDsEndereco($dsEndereco)
    {
        $this->ds_endereco = $dsEndereco;
    }

    /**
     * Get ds_endereco
     *
     * @return string 
     */
    public function getDsEndereco()
    {
        return $this->ds_endereco;
    }

    /**
     * Set ds_complemento
     *
     * @param string $dsComplemento
     */
    public function setDsComplemento($dsComplemento)
    {
        $this->ds_complemento = $dsComplemento;
    }

    /**
     * Get ds_complemento
     *
     * @return string 
     */
    public function getDsComplemento()
    {
        return $this->ds_complemento;
    }

    /**
     * Set ds_numero
     *
     * @param string $dsNumero
     */
    public function setDsNumero($dsNumero)
    {
        $this->ds_numero = $dsNumero;
    }

    /**
     * Get ds_numero
     *
     * @return string 
     */
    public function getDsNumero()
    {
        return $this->ds_numero;
    }

    /**
     * Set nr_cep
     *
     * @param integer $nrCep
     */
    public function setNrCep($nrCep)
    {
        $this->nr_cep = $nrCep;
    }

    /**
     * Get nr_cep
     *
     * @return integer 
     */
    public function getNrCep()
    {
        return $this->nr_cep;
    }

    /**
     * Set ds_bairro
     *
     * @param string $dsBairro
     */
    public function setDsBairro($dsBairro)
    {
        $this->ds_bairro = $dsBairro;
    }

    /**
     * Get ds_bairro
     *
     * @return string 
     */
    public function getDsBairro()
    {
        return $this->ds_bairro;
    }

    /**
     * Set ds_cidade
     *
     * @param string $dsCidade
     */
    public function setDsCidade($dsCidade)
    {
        $this->ds_cidade = $dsCidade;
    }

    /**
     * Get ds_cidade
     *
     * @return string 
     */
    public function getDsCidade()
    {
        return $this->ds_cidade;
    }

    /**
     * Set ds_como_conheceu
     *
     * @param string $dsComoConheceu
     */
    public function setDsComoConheceu($dsComoConheceu)
    {
        $this->ds_como_conheceu = $dsComoConheceu;
    }

    /**
     * Get ds_como_conheceu
     *
     * @return string 
     */
    public function getDsComoConheceu()
    {
        return $this->ds_como_conheceu;
    }

    /**
     * Set dt_criacao
     *
     * @param datetime $dtCriacao
     */
    public function setDtCriacao($dtCriacao)
    {
        $this->dt_criacao = $dtCriacao;
    }

    /**
     * Get dt_criacao
     *
     * @return datetime 
     */
    public function getDtCriacao()
    {
        return $this->dt_criacao;
    }

    /**
     * Set dt_atualizacao
     *
     * @param datetime $dtAtualizacao
     */
    public function setDtAtualizacao($dtAtualizacao)
    {
        $this->dt_atualizacao = $dtAtualizacao;
    }

    /**
     * Get dt_atualizacao
     *
     * @return datetime 
     */
    public function getDtAtualizacao()
    {
        return $this->dt_atualizacao;
    }
    public function __construct()
    {
        $this->noticias = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add noticias
     *
     * @param PHPReview\WebsiteBundle\Entity\Noticias $noticias
     */
    public function addNoticias(\PHPReview\WebsiteBundle\Entity\Noticias $noticias)
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
     * @param PHPReview\AdminBundle\Estado $estado
     */
    public function setEstado(\PHPReview\AdminBundle\Estado $estado)
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
}