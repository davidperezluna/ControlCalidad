<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nivel
 *
 * @ORM\Table(name="nivel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NivelRepository")
 */
class Nivel
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
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=255)
     */
    private $color;
    /**
     * @var int
     *
     * @ORM\Column(name="valorMinimo", type="integer")
     */
    private $valorMinimo;

    /**
     * @var int
     *
     * @ORM\Column(name="valorMaximo", type="integer")
     */
    private $valorMaximo;




     /**
     * @ORM\ManyToOne(targetEntity="Rango", inversedBy="niveles")
     */
    protected $rango;


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
     * @return Nivel
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
     * Set valorMaximo
     *
     * @param integer $valorMaximo
     *
     * @return Nivel
     */
    public function setValorMaximo($valorMaximo)
    {
        $this->valorMaximo = $valorMaximo;

        return $this;
    }

    /**
     * Get valorMaximo
     *
     * @return int
     */
    public function getValorMaximo()
    {
        return $this->valorMaximo;
    }

    /**
     * Set rango
     *
     * @param \AppBundle\Entity\Rango $rango
     *
     * @return Nivel
     */
    public function setRango(\AppBundle\Entity\Rango $rango = null)
    {
        $this->rango = $rango;

        return $this;
    }

    /**
     * Get rango
     *
     * @return \AppBundle\Entity\Rango
     */
    public function getRango()
    {
        return $this->rango;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Nivel
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set valorMinimo
     *
     * @param integer $valorMinimo
     *
     * @return Nivel
     */
    public function setValorMinimo($valorMinimo)
    {
        $this->valorMinimo = $valorMinimo;

        return $this;
    }

    /**
     * Get valorMinimo
     *
     * @return integer
     */
    public function getValorMinimo()
    {
        return $this->valorMinimo;
    }
}
