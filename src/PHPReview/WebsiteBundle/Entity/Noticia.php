<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PHPReview\AdminBundle\Entity;

/**
 * PHPReview\WebsiteBundle\Entity\Noticia
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Noticia
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id_noticia", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $ds_titulo
     *
     * @ORM\Column(name="ds_titulo", type="string")
     */
    private $ds_titulo;

    /**
     * @var string $ds_apelido
     *
     * @ORM\Column(name="ds_apelido", type="string")
     */
    private $ds_apelido;

    /**
     * @var string $ds_resumo
     *
     * @ORM\Column(name="ds_resumo", type="string")
     */
    private $ds_resumo;

    /**
     * @var text $tx_materia
     *
     * @ORM\Column(name="tx_materia", type="text")
     */
    private $tx_materia;

    /**
     * @var datetime $dt_publicacao
     *
     * @ORM\Column(name="dt_publicacao", type="datetime")
     */
    private $dt_publicacao;

    /**
     * @var datetime $dt_alteracao
     *
     * @ORM\Column(name="dt_alteracao", type="datetime")
     */
    private $dt_alteracao;

    /**
     * @var datetime $dt_limite
     *
     * @ORM\Column(name="dt_limite", type="datetime")
     */
    private $dt_limite;

    /**
     * @var boolean $in_home
     *
     * @ORM\Column(name="in_home", type="boolean")
     */
    private $in_home;

    /**
     * @var string $url_imagem
     *
     * @ORM\Column(name="url_imagem", type="string")
     */
    private $url_imagem;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario",inversedBy="noticias")
     * @ORM\JoinColumn(name="id_usuario",referencedColumnName="id_usuario")
     */
    private $usuario;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="\PHPReview\AdminBundle\Entity\Tags",inversedBy="noticias",cascade={"persist"})
     * @ORM\JoinTable(name="TagNoticia",joinColumns={@ORM\JoinColumn(name="id_noticia",referencedColumnName="id_noticia")},
     * inverseJoinColumns={@ORM\JoinColumn(name="id_tag",referencedColumnName="id_tag")})
     */
    private $tags;

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
     * Set ds_titulo
     *
     * @param string $dsTitulo
     */
    public function setDsTitulo($dsTitulo)
    {
        $this->ds_titulo = $dsTitulo;
    }

    /**
     * Get ds_titulo
     *
     * @return string 
     */
    public function getDsTitulo()
    {
        return $this->ds_titulo;
    }

    /**
     * Set ds_apelido
     *
     * @param string $dsApelido
     */
    public function setDsApelido($dsApelido)
    {
        $this->ds_apelido = $dsApelido;
    }

    /**
     * Get ds_apelido
     *
     * @return string 
     */
    public function getDsApelido()
    {
        return $this->ds_apelido;
    }

    /**
     * Set ds_resumo
     *
     * @param string $dsResumo
     */
    public function setDsResumo($dsResumo)
    {
        $this->ds_resumo = $dsResumo;
    }

    /**
     * Get ds_resumo
     *
     * @return string 
     */
    public function getDsResumo()
    {
        return $this->ds_resumo;
    }

    /**
     * Set tx_materia
     *
     * @param text $txMateria
     */
    public function setTxMateria($txMateria)
    {
        $this->tx_materia = $txMateria;
    }

    /**
     * Get tx_materia
     *
     * @return text 
     */
    public function getTxMateria()
    {
        return $this->tx_materia;
    }

    /**
     * Set dt_publicacao
     *
     * @param datetime $dtPublicacao
     */
    public function setDtPublicacao($dtPublicacao)
    {
        $this->dt_publicacao = $dtPublicacao;
    }

    /**
     * Get dt_publicacao
     *
     * @return datetime 
     */
    public function getDtPublicacao()
    {
        return $this->dt_publicacao;
    }

    /**
     * Set dt_alteracao
     *
     * @param datetime $dtAlteracao
     */
    public function setDtAlteracao($dtAlteracao)
    {
        $this->dt_alteracao = $dtAlteracao;
    }

    /**
     * Get dt_alteracao
     *
     * @return datetime 
     */
    public function getDtAlteracao()
    {
        return $this->dt_alteracao;
    }

    /**
     * Set dt_limite
     *
     * @param datetime $dtLimite
     */
    public function setDtLimite($dtLimite)
    {
        $this->dt_limite = $dtLimite;
    }

    /**
     * Get dt_limite
     *
     * @return datetime 
     */
    public function getDtLimite()
    {
        return $this->dt_limite;
    }

    /**
     * Set in_home
     *
     * @param boolean $inHome
     */
    public function setInHome($inHome)
    {
        $this->in_home = $inHome;
    }

    /**
     * Get in_home
     *
     * @return boolean 
     */
    public function getInHome()
    {
        return $this->in_home;
    }

    /**
     * Set url_imagem
     *
     * @param string $urlImagem
     */
    public function setUrlImagem($urlImagem)
    {
        $this->url_imagem = $urlImagem;
    }

    /**
     * Get url_imagem
     *
     * @return string 
     */
    public function getUrlImagem()
    {
        return $this->url_imagem;
    }
    
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set usuario
     *
     * @param PHPReview\WebsiteBundle\Entity\Usuario $usuario
     */
    public function setUsuario(\PHPReview\WebsiteBundle\Entity\Usuario $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get usuario
     *
     * @return PHPReview\WebsiteBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}