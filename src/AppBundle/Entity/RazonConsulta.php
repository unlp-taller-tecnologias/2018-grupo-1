<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * RazonConsulta
 *
 * @ORM\Table(name="razon_consulta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RazonConsultaRepository")
 */
class RazonConsulta
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
     * @ORM\Column(name="descripcion", type="string", length=25, unique=true)
     */
    private $descripcion;

    /**
     * One RazonConsulta has Many Expedientes.
     * @ORM\OneToMany(targetEntity="Expediente", mappedBy="razonConsulta")
     */
    private $expedientes;

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
     * @return RazonConsulta
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
}
