<?php

namespace PHPReview\AdminBundle\Entity;

use PHPReview\WebsiteBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\AdminBundle\Entity\Estados
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Estados
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id_estado", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $ds_estado
     *
     * @ORM\Column(name="ds_estado", type="string", length=100)
     */
    private $ds_estado;

    /**
     * @var boolean $in_disponivel
     *
     * @ORM\Column(name="in_disponivel", type="boolean")
     */
    private $in_disponivel;
    
    /**
     *
     * @var PHPReview\WebsiteBundle\Usuario $usuario
     * @ORM\OneToMany(targetEntity="PHPReview\WebsiteBundle\Usuario",mappedBy="estado")
     */
    private $usuarios;


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
     * Set ds_estado
     *
     * @param string $dsEstado
     */
    public function setDsEstado($dsEstado)
    {
        $this->ds_estado = $dsEstado;
    }

    /**
     * Get ds_estado
     *
     * @return string 
     */
    public function getDsEstado()
    {
        return $this->ds_estado;
    }

    /**
     * Set in_disponivel
     *
     * @param boolean $inDisponivel
     */
    public function setInDisponivel($inDisponivel)
    {
        $this->in_disponivel = $inDisponivel;
    }

    /**
     * Get in_disponivel
     *
     * @return boolean 
     */
    public function getInDisponivel()
    {
        return $this->in_disponivel;
    }
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add usuarios
     *
     * @param PHPReview\WebsiteBundle\Usuario $usuarios
     */
    public function addUsuario(\PHPReview\WebsiteBundle\Usuario $usuarios)
    {
        $this->usuarios[] = $usuarios;
    }

    /**
     * Get usuarios
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}