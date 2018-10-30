<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IntervencionJudicial
 *
 * @ORM\Table(name="intervencion_judicial")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IntervencionJudicialRepository")
 */
class IntervencionJudicial
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
     * @return IntervencionJudicial
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
