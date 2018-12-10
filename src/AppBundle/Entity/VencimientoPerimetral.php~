<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VencimientoPerimetral
 *
 * @ORM\Table(name="vencimiento_perimetral")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VencimientoPerimetralRepository")
 */
class VencimientoPerimetral
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
     * @var int
     *
     * @ORM\Column(name="diasNotificacion", type="smallint")
     */
    private $diasNotificacion;


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
     * Set diasNotificacion.
     *
     * @param int $diasNotificacion
     *
     * @return VencimientoPerimetral
     */
    public function setDiasNotificacion($diasNotificacion)
    {
        $this->diasNotificacion = $diasNotificacion;

        return $this;
    }

    /**
     * Get diasNotificacion.
     *
     * @return int
     */
    public function getDiasNotificacion()
    {
        return $this->diasNotificacion;
    }
}
