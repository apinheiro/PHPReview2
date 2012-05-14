<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\WebsiteBundle\Entity\ComoConheceu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class ComoConheceu
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
     * @var string $ds_como_conheceu
     *
     * @ORM\Column(name="ds_como_conheceu", type="string")
     */
    private $ds_como_conheceu;

    /**
     * @var boolean $in_ativo
     *
     * @ORM\Column(name="in_ativo", type="boolean")
     */
    private $in_ativo;


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
     * Set in_ativo
     *
     * @param boolean $inAtivo
     */
    public function setInAtivo($inAtivo)
    {
        $this->in_ativo = $inAtivo;
    }

    /**
     * Get in_ativo
     *
     * @return boolean 
     */
    public function getInAtivo()
    {
        return $this->in_ativo;
    }
}