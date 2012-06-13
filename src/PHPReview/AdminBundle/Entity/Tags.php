<?php

namespace PHPReview\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\AdminBundle\Entity\Tags
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Tags
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
     * @ORM\Column(name="nome", type="string", length=200)
     */
    private $nome;

    /**
     * @ORM\ManyToMany(targetEntity="PHPReview\WebsiteBundle\Entity\Noticia",mappedBy="tags",cascade={"persist"})
     */
    private $noticias;
    
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
    public function __construct()
    {
        $this->noticias = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get noticias
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getNoticias()
    {
        return $this->noticias;
    }
}