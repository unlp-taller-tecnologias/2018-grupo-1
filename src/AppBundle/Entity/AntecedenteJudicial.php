<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AntecedenteJudicial
 *
 * @ORM\Table(name="antecedente_judicial")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AntecedenteJudicialRepository")
 */
class AntecedenteJudicial
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var bool
     *
     * @ORM\Column(name="realizoDenuncia", type="boolean")
     */
    private $realizoDenuncia;

    /**
     * @var \Date|null
     *
     * @ORM\Column(name="fechaRealizoDenuncia", type="date", nullable=true)
     */
    private $fechaRealizoDenuncia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obsRealizoDenuncia", type="string", length=255, nullable=true)
     */
    private $obsRealizoDenuncia;

    /**
     * @var bool
     *
     * @ORM\Column(name="denunciaPrevia", type="boolean")
     */
    private $denunciaPrevia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="obsDenunciaPrevia", type="string", length=255, nullable=true)
     */
    private $obsDenunciaPrevia;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set realizoDenuncia.
     *
     * @param bool $realizoDenuncia
     *
     * @return AntecedenteJudicial
     */
    public function setRealizoDenuncia($realizoDenuncia)
    {
        $this->realizoDenuncia = $realizoDenuncia;

        return $this;
    }

    /**
     * Get realizoDenuncia.
     *
     * @return bool
     */
    public function getRealizoDenuncia()
    {
        return $this->realizoDenuncia;
    }

    /**
     * Set fechaRealizoDenuncia.
     *
     * @param \Date|null $fechaRealizoDenuncia
     *
     * @return AntecedenteJudicial
     */
    public function setFechaRealizoDenuncia($fechaRealizoDenuncia = null)
    {
        $this->fechaRealizoDenuncia = $fechaRealizoDenuncia;

        return $this;
    }

    /**
     * Get fechaRealizoDenuncia.
     *
     * @return \Date|null
     */
    public function getFechaRealizoDenuncia()
    {
        return $this->fechaRealizoDenuncia;
    }

    /**
     * Set obsRealizoDenuncia.
     *
     * @param string|null $obsRealizoDenuncia
     *
     * @return AntecedenteJudicial
     */
    public function setObsRealizoDenuncia($obsRealizoDenuncia = null)
    {
        $this->obsRealizoDenuncia = $obsRealizoDenuncia;

        return $this;
    }

    /**
     * Get obsRealizoDenuncia.
     *
     * @return string|null
     */
    public function getObsRealizoDenuncia()
    {
        return $this->obsRealizoDenuncia;
    }

    /**
     * Set denunciaPrevia.
     *
     * @param bool $denunciaPrevia
     *
     * @return AntecedenteJudicial
     */
    public function setDenunciaPrevia($denunciaPrevia)
    {
        $this->denunciaPrevia = $denunciaPrevia;

        return $this;
    }

    /**
     * Get denunciaPrevia.
     *
     * @return bool
     */
    public function getDenunciaPrevia()
    {
        return $this->denunciaPrevia;
    }

    /**
     * Set obsDenunciaPrevia.
     *
     * @param string|null $obsDenunciaPrevia
     *
     * @return AntecedenteJudicial
     */
    public function setObsDenunciaPrevia($obsDenunciaPrevia = null)
    {
        $this->obsDenunciaPrevia = $obsDenunciaPrevia;

        return $this;
    }

    /**
     * Get obsDenunciaPrevia.
     *
     * @return string|null
     */
    public function getObsDenunciaPrevia()
    {
        return $this->obsDenunciaPrevia;
    }
}