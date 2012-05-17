<?php

namespace PHPReview\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\AdminBundle\Entity\HistoricoDownload
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class HistoricoDownload
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
     * @var integer $id_publicacao
     *
     * @ORM\ManyToOne(targetEntity="PHPReview\WebsiteBundle\Entity\Publicacao")
     * @ORM\JoinColumn(name="id_publicacao",referencedColumnName="id_publicacao")
     */
    private $publicacao;

    /**
     * @var datetime $dt_download
     *
     * @ORM\Column(name="dt_download", type="datetime")
     */
    private $dt_download;

    /**
     * @var string $ip_cliente
     *
     * @ORM\Column(name="ip_cliente", type="string", length=20)
     */
    private $ip_cliente;

    /**
     * @var integer $id_usuario
     *
     * @ORM\ManyToOne(targetEntity="PHPReview\WebsiteBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="id_usuario",referencedColumnName="id_usuario")
     */
    private $usuario;


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
     * Set dt_download
     *
     * @param datetime $dtDownload
     */
    public function setDtDownload($dtDownload)
    {
        $this->dt_download = $dtDownload;
    }

    /**
     * Get dt_download
     *
     * @return datetime 
     */
    public function getDtDownload()
    {
        return $this->dt_download;
    }

    /**
     * Set ip_cliente
     *
     * @param string $ipCliente
     */
    public function setIpCliente($ipCliente)
    {
        $this->ip_cliente = $ipCliente;
    }

    /**
     * Get ip_cliente
     *
     * @return string 
     */
    public function getIpCliente()
    {
        return $this->ip_cliente;
    }

    

    

    /**
     * Set publicacao
     *
     * @param PHPReview\WebsiteBundle\Entity\Publicacao $publicacao
     */
    public function setPublicacao(\PHPReview\WebsiteBundle\Entity\Publicacao $publicacao)
    {
        $this->publicacao = $publicacao;
    }

    /**
     * Get publicacao
     *
     * @return PHPReview\WebsiteBundle\Entity\Publicacao 
     */
    public function getPublicacao()
    {
        return $this->publicacao;
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