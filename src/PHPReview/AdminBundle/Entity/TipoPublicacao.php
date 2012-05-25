<?php

namespace PHPReview\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PHPReview\AdminBundle\Entity\TipoPublicacao
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoPublicacao
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
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=100)
     * @Assert\NotBlank(message="O nome não pode ser vazio.");
     */
    private $nome;

    /**
     * @var text $descricao
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @var datetime $data_cadastro
     *
     * @ORM\Column(name="data_cadastro", type="datetime")
     */
    private $data_cadastro;

    /**
     * @var PHPReview\WebsiteBundle\Entity\Usuario $login_cadastro
     * 
     * @ORM\OneToOne(targetEntity="PHPReview\WebsiteBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="login_cadastro",referencedColumnName="id_usuario")
     * 
     */
    private $login_cadastro;
    
    
    /**
     * @var boolean $ativo
     * 
     * @ORM\Column(name="ativo",type="boolean")
     */
    private $ativo;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="PHPReview\WebsiteBundle\Entity\Publicacao",mappedBy="tipoPublicacao")
     */
    private $publicacoes;


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
     * Set nome
     *
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descricao
     *
     * @param text $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * Get descricao
     *
     * @return text 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set data_cadastro
     *
     * @param datetime $dataCadastro
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->data_cadastro = $dataCadastro;
    }

    /**
     * Get data_cadastro
     *
     * @return datetime 
     */
    public function getDataCadastro()
    {
        return $this->data_cadastro;
    }


    /**
     * Set ativo
     *
     * @param boolean $ativo
     */
    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    /**
     * Get ativo
     *
     * @return boolean 
     */
    public function getAtivo()
    {
        return $this->ativo;
    }

    /**
     * Set login_cadastro
     *
     * @param PHPReview\WebsiteBundle\Entity\Usuario $loginCadastro
     */
    public function setLoginCadastro(\PHPReview\WebsiteBundle\Entity\Usuario $loginCadastro)
    {
        $this->login_cadastro = $loginCadastro;
    }

    /**
     * Get login_cadastro
     *
     * @return PHPReview\WebsiteBundle\Entity\Usuario 
     */
    public function getLoginCadastro()
    {
        return $this->login_cadastro;
    }
    public function __construct()
    {
        $this->publicacoes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add publicacoes
     *
     * @param PHPReview\WebsiteBundle\Entity\Publicacao $publicacoes
     */
    public function addPublicacoes(\PHPReview\WebsiteBundle\Entity\Publicacao $publicacoes)
    {
        $this->publicacoes[] = $publicacoes;
    }

    /**
     * Get publicacoes
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPublicacoes()
    {
        return $this->publicacoes;
    }
}