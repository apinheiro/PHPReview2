<?php

namespace PHPReview\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\AdminBundle\Entity\Chave
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Chave
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
 * @ORM\Column(name="chave", type="string",length="200")
 * @var type 
 */
    private $chave;
    /**
     * @var datetime $data_registro
     *
     * @ORM\Column(name="data_registro", type="datetime")
     */
    private $data_registro;

    /**
     * @var datetime $data_expira
     *
     * @ORM\Column(name="data_expira", type="datetime")
     */
    private $data_expira;

    /**
     * @var boolean $in_usado
     *
     * @ORM\Column(name="in_usado", type="boolean")
     */
    private $in_usado;

    /**
     * @var boolean $in_expirado
     *
     * @ORM\Column(name="in_expirado", type="boolean")
     */
    private $in_expirado;
    
    /**
     * @var integer $id_usuario
     *
     * @ORM\ManyToOne(targetEntity="TipoChave", inversedBy="chaves")
     * @ORM\JoinColumn(name="id_tipo_chave",referencedColumnName="id")
     */
    private $tipo_chave;
    
    /**
     * @var integer $id_usuario
     *
     * @ORM\ManyToOne(targetEntity="PHPReview\WebsiteBundle\Entity\Usuario",inversedBy="chaves")
     * @ORM\JoinColumn(name="id_usuario",referencedColumnName="id")
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
     * Set data_registro
     *
     * @param datetime $dataRegistro
     */
    public function setDataRegistro(\Datetime $dataRegistro)
    {
        $this->data_registro = $dataRegistro;
    }

    /**
     * Get data_registro
     *
     * @return datetime 
     */
    public function getDataRegistro()
    {
        return $this->data_registro;
    }

    /**
     * Set data_expira
     *
     * @param datetime $dataExpira
     */
    public function setDataExpira(\Datetime $dataExpira)
    {
        $this->data_expira = $dataExpira;
    }

    /**
     * Get data_expira
     *
     * @return datetime 
     */
    public function getDataExpira()
    {
        return $this->data_expira;
    }

    /**
     * Set in_usado
     *
     * @param boolean $inUsado
     */
    public function setInUsado($inUsado)
    {
        $this->in_usado = $inUsado;
    }

    /**
     * Get in_usado
     *
     * @return boolean 
     */
    public function getInUsado()
    {
        return $this->in_usado;
    }

    /**
     * Set in_expirado
     *
     * @param boolean $inExpirado
     */
    public function setInExpirado($inExpirado)
    {
        $this->in_expirado = $inExpirado;
    }

    /**
     * Get in_expirado
     *
     * @return boolean 
     */
    public function getInExpirado()
    {
        return $this->in_expirado;
    }

    /**
     * Set tipo_chave
     *
     * @param PHPReview\AdminBundle\Entity\TipoChave $tipoChave
     */
    public function setTipoChave(\PHPReview\AdminBundle\Entity\TipoChave $tipoChave)
    {
        $this->tipo_chave = $tipoChave;
    }

    /**
     * Get tipo_chave
     *
     * @return PHPReview\AdminBundle\Entity\TipoChave 
     */
    public function getTipoChave()
    {
        return $this->tipo_chave;
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
    /**
     *
     * @return string 
     */
    public function getChave(){
        return $this->chave;
    }
    
    /**
     *
     * @param string $chave 
     */
    public function setChave($chave){
        $this->chave = $chave;
    }
    
    public static function generateChave($tamanho = 10){
        $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $item = '';
        $i = 0;
        while ($i < $tamanho){
            $num = rand(0,strlen($letras)-1);
            $item .= $letras[$num];
            $i++;
        }
        return $item;
    }
}