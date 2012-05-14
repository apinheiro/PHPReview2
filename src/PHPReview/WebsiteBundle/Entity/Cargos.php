<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\WebsiteBundle\Entity\Cargos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cargos
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id_cargo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $ds_cargo
     *
     * @ORM\Column(name="ds_cargo", type="string")
     */
    private $ds_cargo;

    /**
     * @var boolean $in_disponivel
     *
     * @ORM\Column(name="in_disponivel", type="boolean")
     */
    private $in_disponivel;
    
    /**
     * 
     * @ORM\OneToMany(targetEntity="Usuario",mappedBy="cargo")
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
     * Set ds_cargo
     *
     * @param string $dsCargo
     */
    public function setDsCargo($dsCargo)
    {
        $this->ds_cargo = $dsCargo;
    }

    /**
     * Get ds_cargo
     *
     * @return string 
     */
    public function getDsCargo()
    {
        return $this->ds_cargo;
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
     * @param PHPReview\WebsiteBundle\Entity\Usuario $usuarios
     */
    public function addUsuario(\PHPReview\WebsiteBundle\Entity\Usuario $usuarios)
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