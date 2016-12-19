<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Rango
 *
 * @ORM\Table(name="rango")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RangoRepository")
 */
class Rango
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_niveles", type="integer")
     */
    private $numeroNiveles;

     /**
     * @ORM\OneToMany(targetEntity="Nivel", mappedBy="rango")
     */
    private $niveles;

    

    public function __construct() {
        $this->niveles = new ArrayCollection();
       
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Rango
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set numeroNiveles
     *
     * @param integer $numeroNiveles
     *
     * @return Rango
     */
    public function setNumeroNiveles($numeroNiveles)
    {
        $this->numeroNiveles = $numeroNiveles;

        return $this;
    }

    /**
     * Get numeroNiveles
     *
     * @return integer
     */
    public function getNumeroNiveles()
    {
        return $this->numeroNiveles;
    }

    /**
     * Add nivele
     *
     * @param \AppBundle\Entity\Nivel $nivele
     *
     * @return Rango
     */
    public function addNivele(\AppBundle\Entity\Nivel $nivele)
    {
        $this->niveles[] = $nivele;

        return $this;
    }

    /**
     * Remove nivele
     *
     * @param \AppBundle\Entity\Nivel $nivele
     */
    public function removeNivele(\AppBundle\Entity\Nivel $nivele)
    {
        $this->niveles->removeElement($nivele);
    }

    /**
     * Get niveles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveles()
    {
        return $this->niveles;
    }
}
