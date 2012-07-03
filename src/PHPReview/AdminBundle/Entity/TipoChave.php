<?php

namespace PHPReview\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\AdminBundle\Entity\TipoChave
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TipoChave
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
     * @var string $ds_tipo_chave
     *
     * @ORM\Column(name="ds_tipo_chave", type="string", length=200)
     */
    private $ds_tipo_chave;
    
    /**
     *
     * @var Chave $usuario
     * @ORM\OneToMany(targetEntity="Chave",mappedBy="tipo_chave")
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
     * Set ds_tipo_chave
     *
     * @param string $dsTipoChave
     */
    public function setDsTipoChave($dsTipoChave)
    {
        $this->ds_tipo_chave = $dsTipoChave;
    }

    /**
     * Get ds_tipo_chave
     *
     * @return string 
     */
    public function getDsTipoChave()
    {
        return $this->ds_tipo_chave;
    }
    public function __construct()
    {
        $this->usuarios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add usuarios
     *
     * @param PHPReview\AdminBundle\Entity\Chave $usuarios
     */
    public function addChave(\PHPReview\AdminBundle\Entity\Chave $usuarios)
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