<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Telefono
 *
 * @ORM\Table(name="telefono")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TelefonoRepository")
 */
class Telefono
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
     * @ORM\Column(name="numero", type="string", length=20)
     */
    private $numero;

    /**
     * @ORM\ManyToMany(targetEntity="Victima", mappedBy="telefonos", cascade={"persist"})
     */
    private $victimas;

    public function __construct()
    {
        $this->victimas = new ArrayCollection();
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
     * Set numero.
     *
     * @param string $numero
     *
     * @return Telefono
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero.
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Add victima.
     *
     * @param \AppBundle\Entity\Victima $victima
     *
     * @return Telefono
     */
    public function addVictima(\AppBundle\Entity\Victima $victima)
    {
        $this->victimas[] = $victima;

        return $this;
    }

    /**
     * Remove victima.
     *
     * @param \AppBundle\Entity\Victima $victima
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeVictima(\AppBundle\Entity\Victima $victima)
    {
        return $this->victimas->removeElement($victima);
    }

    /**
     * Get victimas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVictimas()
    {
        return $this->victimas;
    }
}
