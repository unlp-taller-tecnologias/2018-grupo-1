<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MedidaJudicial
 *
 * @ORM\Table(name="medida_judicial")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MedidaJudicialRepository")
 */
class MedidaJudicial
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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=35, unique=true)
     */
    private $descripcion;

    /**
     * @var int|null
     *
     * @ORM\Column(name="orden", type="smallint", nullable=true)
     */
    private $orden;

    /**
     * @ORM\OneToOne(targetEntity="Perimetral", inversedBy="medidaJudicial")
     * @ORM\JoinColumn(name="perimetral_id", referencedColumnName="id")
     */
    private $perimetral;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;


    /**
     * Set activo.
     *
     * @param bool $activo
     *
     * @return AntecedenteJudicial
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo.
     *
     * @return bool
     */
    public function getActivo()
    {
        return $this->activo;
    }
    
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
     * Set descripcion.
     *
     * @param string $descripcion
     *
     * @return MedidaJudicial
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set orden.
     *
     * @param int|null $orden
     *
     * @return MedidaJudicial
     */
    public function setOrden($orden = null)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden.
     *
     * @return int|null
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set perimetral.
     *
     * @param \AppBundle\Entity\Perimetral|null $perimetral
     *
     * @return MedidaJudicial
     */
    public function setPerimetral(\AppBundle\Entity\Perimetral $perimetral = null)
    {
        $this->perimetral = $perimetral;

        return $this;
    }

    /**
     * Get perimetral.
     *
     * @return \AppBundle\Entity\Perimetral|null
     */
    public function getPerimetral()
    {
        return $this->perimetral;
    }
}
