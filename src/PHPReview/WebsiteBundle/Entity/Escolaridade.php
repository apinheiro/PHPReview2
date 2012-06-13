<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\WebsiteBundle\Entity\Escolaridade
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Escolaridade
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
     * @var string $ds_escolaridade
     *
     * @ORM\Column(name="ds_escolaridade", type="string", length=100)
     */
    private $ds_escolaridade;

    /**
     * @var boolean $in_disponivel
     *
     * @ORM\Column(name="in_disponivel", type="boolean")
     */
    private $in_disponivel;
    
    /**
     *
     * @var Usuario $usuario
     * @ORM\OneToMany(targetEntity="Usuario",mappedBy="escolaridade")
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
     * Set ds_escolaridade
     *
     * @param string $dsEscolaridade
     */
    public function setDsEscolaridade($dsEscolaridade)
    {
        $this->ds_escolaridade = $dsEscolaridade;
    }

    /**
     * Get ds_escolaridade
     *
     * @return string 
     */
    public function getDsEscolaridade()
    {
        return $this->ds_escolaridade;
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