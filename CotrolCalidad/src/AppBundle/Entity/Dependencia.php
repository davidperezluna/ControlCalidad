<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Dependencia
 *
 * @ORM\Table(name="dependencia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DependenciaRepository")
 */
class Dependencia
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
     * @ORM\Column(name="nit", type="integer")
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
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="dependencias")
     */
    protected $empresa;

     /**
     * @ORM\OneToMany(targetEntity="MacroProceso", mappedBy="dependencia")
     */
    private $macroProcesos;

    /**
     * @ORM\OneToMany(targetEntity="Categoria", mappedBy="dependencia")
     */
    private $categorias;

    public function __construct() {
        $this->macroProcesos = new ArrayCollection();
        $this->categorias = new ArrayCollection();
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
     * @return Dependencia
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
     * @return Dependencia
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
     * @return Dependencia
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
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Dependencia
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Add macroProceso
     *
     * @param \AppBundle\Entity\MacroProceso $macroProceso
     *
     * @return Dependencia
     */
    public function addMacroProceso(\AppBundle\Entity\MacroProceso $macroProceso)
    {
        $this->macroProcesos[] = $macroProceso;

        return $this;
    }

    /**
     * Remove macroProceso
     *
     * @param \AppBundle\Entity\MacroProceso $macroProceso
     */
    public function removeMacroProceso(\AppBundle\Entity\MacroProceso $macroProceso)
    {
        $this->macroProcesos->removeElement($macroProceso);
    }

    /**
     * Get macroProcesos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMacroProcesos()
    {
        return $this->macroProcesos;
    }

    /**
     * Add categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return Dependencia
     */
    public function addCategoria(\AppBundle\Entity\Categoria $categoria)
    {
        $this->categorias[] = $categoria;

        return $this;
    }

    /**
     * Remove categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     */
    public function removeCategoria(\AppBundle\Entity\Categoria $categoria)
    {
        $this->categorias->removeElement($categoria);
    }

    /**
     * Get categorias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorias()
    {
        return $this->categorias;
    }
}
