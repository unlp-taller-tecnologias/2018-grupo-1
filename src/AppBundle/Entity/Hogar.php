<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Hogar
 *
 * @ORM\Table(name="hogar")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HogarRepository")
 */
class Hogar
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
     * @var \DateTime
     *
     * @ORM\Column(name="ingreso", type="datetime")
     */
    private $ingreso;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="egreso", type="datetime", nullable=true)
     */
    private $egreso;


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
     * Set ingreso.
     *
     * @param \DateTime $ingreso
     *
     * @return Hogar
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso.
     *
     * @return \DateTime
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set egreso.
     *
     * @param \DateTime|null $egreso
     *
     * @return Hogar
     */
    public function setEgreso($egreso = null)
    {
        $this->egreso = $egreso;

        return $this;
    }

    /**
     * Get egreso.
     *
     * @return \DateTime|null
     */
    public function getEgreso()
    {
        return $this->egreso;
    }
}
