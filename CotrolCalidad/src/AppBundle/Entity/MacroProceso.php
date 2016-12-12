<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MacroPoceso
 *
 * @ORM\Table(name="macro_proceso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MacroPocesoRepository")
 */
class MacroProceso
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
     * @ORM\Column(name="sigla", type="string" , length=255)
     */
    private $sigla;

    /**
     * @ORM\ManyToOne(targetEntity="Dependencia", inversedBy="macroProcesos")
     */
    protected $dependencia;

    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="macroProcesos")
     */
    protected $categoria;

     /**
     * @ORM\OneToMany(targetEntity="Proceso", mappedBy="macroProceso")
     */
    private $procesos;

    public function __construct() {
        $this->procesos = new ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MacroPoceso
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
     * Set dependencia
     *
     * @param \AppBundle\Entity\Dependencia $dependencia
     *
     * @return MacroPoceso
     */
    public function setDependencia(\AppBundle\Entity\Dependencia $dependencia = null)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return \AppBundle\Entity\Dependencia
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set categoria
     *
     * @param \AppBundle\Entity\Categoria $categoria
     *
     * @return MacroPoceso
     */
    public function setCategoria(\AppBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \AppBundle\Entity\Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Add proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     *
     * @return MacroPoceso
     */
    public function addProceso(\AppBundle\Entity\Proceso $proceso)
    {
        $this->procesos[] = $proceso;

        return $this;
    }

    /**
     * Remove proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     */
    public function removeProceso(\AppBundle\Entity\Proceso $proceso)
    {
        $this->procesos->removeElement($proceso);
    }

    /**
     * Get procesos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcesos()
    {
        return $this->procesos;
    }

    /** 
     * Set sigla
     *
     * @param string $sigla
     *
     * @return MacroProceso
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;

        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }
}
