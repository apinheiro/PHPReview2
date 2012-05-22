<?php

namespace PHPReview\WebsiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PHPReview\WebsiteBundle\Entity\Publicacao
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Publicacao
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
     * @var string $ds_titulo
     *
     * @ORM\Column(name="ds_titulo", type="string", length=100)
     */
    private $ds_titulo;

    /**
     * @var text $tx_resumo
     *
     * @ORM\Column(name="tx_resumo", type="text")
     */
    private $tx_resumo;

    /**
     * @var string $nr_edicao
     *
     * @ORM\Column(name="nr_edicao", type="string", length=20)
     */
    private $nr_edicao;

    /**
     * @var strign $ano_publicacao
     *
     * @ORM\Column(name="ano_publicacao", type="strign", length=4)
     */
    private $ano_publicacao;

    /**
     * @var string $ds_periodo
     *
     * @ORM\Column(name="ds_periodo", type="string", length=30)
     */
    private $ds_periodo;

    /**
     * @var string $ds_arquivo
     *
     * @ORM\Column(name="ds_arquivo", type="string")
     */
    private $ds_arquivo;

    /**
     * @var datetime $dt_publicacao
     *
     * @ORM\Column(name="dt_publicacao", type="datetime")
     */
    private $dt_publicacao;
    
    /**
     * @ORM\ManyToOne(targetEntity="PHPReview\AdminBundle\Entity\TipoPublicacao",inversedBy="publicacoes")
     * @ORM\JoinColumn(name="id_tipo_publicacao",referencedColumnName="id")
    */
    private $tipoPublicacao;


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
     * Set tx_resumo
     *
     * @param text $txResumo
     */
    public function setTxResumo($txResumo)
    {
        $this->tx_resumo = $txResumo;
    }

    /**
     * Get tx_resumo
     *
     * @return text 
     */
    public function getTxResumo()
    {
        return $this->tx_resumo;
    }

    /**
     * Set nr_edicao
     *
     * @param string $nrEdicao
     */
    public function setNrEdicao($nrEdicao)
    {
        $this->nr_edicao = $nrEdicao;
    }

    /**
     * Get nr_edicao
     *
     * @return string 
     */
    public function getNrEdicao()
    {
        return $this->nr_edicao;
    }

    /**
     * Set ano_publicacao
     *
     * @param strign $anoPublicacao
     */
    public function setAnoPublicacao(\strign $anoPublicacao)
    {
        $this->ano_publicacao = $anoPublicacao;
    }

    /**
     * Get ano_publicacao
     *
     * @return strign 
     */
    public function getAnoPublicacao()
    {
        return $this->ano_publicacao;
    }

    /**
     * Set ds_periodo
     *
     * @param string $dsPeriodo
     */
    public function setDsPeriodo($dsPeriodo)
    {
        $this->ds_periodo = $dsPeriodo;
    }

    /**
     * Get ds_periodo
     *
     * @return string 
     */
    public function getDsPeriodo()
    {
        return $this->ds_periodo;
    }

    /**
     * Set ds_arquivo
     *
     * @param string $dsArquivo
     */
    public function setDsArquivo($dsArquivo)
    {
        $this->ds_arquivo = $dsArquivo;
    }

    /**
     * Get ds_arquivo
     *
     * @return string 
     */
    public function getDsArquivo()
    {
        return $this->ds_arquivo;
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
     * Set tipoPublicacao
     *
     * @param PHPReview\AdminBundle\Entity\TipoPublicacao $tipoPublicacao
     */
    public function setTipoPublicacao(\PHPReview\AdminBundle\Entity\TipoPublicacao $tipoPublicacao)
    {
        $this->tipoPublicacao = $tipoPublicacao;
    }

    /**
     * Get tipoPublicacao
     *
     * @return PHPReview\AdminBundle\Entity\TipoPublicacao 
     */
    public function getTipoPublicacao()
    {
        return $this->tipoPublicacao;
    }
}