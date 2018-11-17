<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Perimetral
 *
 * @ORM\Table(name="perimetral")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PerimetralRepository")
 */
class Perimetral
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
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @var \Date
     *
     * @ORM\Column(name="vencimiento", type="date")
     */
    private $vencimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="vigencia", type="string", length=10, nullable=true)
     */
    private $vigencia;

    /**
     * @ORM\OneToOne(targetEntity="MedidaJudicial", mappedBy="perimetral")
     */
    private $medidaJudicial;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="resuelta", type="boolean", nullable=false)
     */
    private $resuelta;


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
     * Set fecha.
     *
     * @param \Date $fecha
     *
     * @return Perimetral
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \Date
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set vencimiento.
     *
     * @param \Date $vencimiento
     *
     * @return Perimetral
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento.
     *
     * @return \Date
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set vigencia.
     *
     * @param string|null $vigencia
     *
     * @return Perimetral
     */
    public function setVigencia($vigencia = null)
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get vigencia.
     *
     * @return string|null
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }

    /**
     * Set medidaJudicial.
     *
     * @param \AppBundle\Entity\MedidaJudicial|null $medidaJudicial
     *
     * @return Perimetral
     */
    public function setMedidaJudicial(\AppBundle\Entity\MedidaJudicial $medidaJudicial = null)
    {
        $this->medidaJudicial = $medidaJudicial;

        return $this;
    }

    /**
     * Get medidaJudicial.
     *
     * @return \AppBundle\Entity\MedidaJudicial|null
     */
    public function getMedidaJudicial()
    {
        return $this->medidaJudicial;
    }


    /**
        * Set resuelta.
        *
        * @param bool $resuelta
        *
        * @return Perimetral
        */
       public function setResuelta($resuelta)
       {
           $this->resuelta = $resuelta;

           return $this;
       }

       /**
        * Get resuelta.
        *
        * @return bool
        */
       public function getResuelta()
       {
           return $this->resuelta;
       }

}
