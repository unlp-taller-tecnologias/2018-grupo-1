<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * MedidaJudicial
 *
 * @ORM\Table(name="medida_judicial")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MedidaJudicialRepository")
 * @UniqueEntity("descripcion", message="Ya existe una medida judicial con esa descripcion")
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
     * @Assert\NotBlank
     * @Assert\LessThan(100)
     * @Assert\GreaterThan(0)
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
     * @return MedidaJudicial
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
