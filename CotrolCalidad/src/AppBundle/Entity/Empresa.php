<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 */
class Empresa
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
     * @ORM\Column(name="nit", type="integer", unique=true)
     */
    private $nit;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="representante", type="string", length=255)
     */
    private $representante;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

     /**
     * @ORM\OneToMany(targetEntity="Dependencia", mappedBy="empresa")
     */
    private $dependencias;

    public function __construct() {
        $this->dependencias = new ArrayCollection();
    }

    public function __toString()
    {
        return (string) $this->getNombre();
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
     * Set nit
     *
     * @param integer $nit
     *
     * @return Empresa
     */
    public function setNit($nit)
    {
        $this->nit = $nit;

        return $this;
    }

    /**
     * Get nit
     *
     * @return int
     */
    public function getNit()
    {
        return $this->nit;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Empresa
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
     * Set representante
     *
     * @param string $representante
     *
     * @return Empresa
     */
    public function setRepresentante($representante)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get representante
     *
     * @return string
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Empresa
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Add dependencia
     *
     * @param \AppBundle\Entity\Dependencia $dependencia
     *
     * @return Empresa
     */
    public function addDependencia(\AppBundle\Entity\Dependencia $dependencia)
    {
        $this->dependencias[] = $dependencia;

        return $this;
    }

    /**
     * Remove dependencia
     *
     * @param \AppBundle\Entity\Dependencia $dependencia
     */
    public function removeDependencia(\AppBundle\Entity\Dependencia $dependencia)
    {
        $this->dependencias->removeElement($dependencia);
    }

    /**
     * Get dependencias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDependencias()
    {
        return $this->dependencias;
    }
}
