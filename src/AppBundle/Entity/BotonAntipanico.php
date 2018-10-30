<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BotonAntipanico
 *
 * @ORM\Table(name="boton_antipanico")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BotonAntipanicoRepository")
 */
class BotonAntipanico
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
     * @ORM\Column(name="fechaEntrega", type="date")
     */
    private $fechaEntrega;


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
     * Set fechaEntrega.
     *
     * @param \Date $fechaEntrega
     *
     * @return BotonAntipanico
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega.
     *
     * @return \Date
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }
}