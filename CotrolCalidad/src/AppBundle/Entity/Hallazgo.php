<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Hallazgo
 *
 * @ORM\Table(name="hallazgo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HallazgoRepository")
 */
class Hallazgo
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
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaHallazgo", type="date")
     */
    private $fechaHallazgo;

    /**
     * @var string
     *
     * @ORM\Column(name="naturaleza", type="text")
     */
    private $naturaleza;

    /**
     * @var string
     *
     * @ORM\Column(name="tratamiento", type="text")
     */
    private $tratamiento;


    /**
     * @ORM\ManyToOne(targetEntity="Auditoria", inversedBy="hallazgos")
     */
    protected $auditoria;

    /**
     * @ORM\ManyToOne(targetEntity="TipoHallazgo", inversedBy="hallazgo")
     */
    protected $tipohallazgo;

     /**
     * @ORM\OneToMany(targetEntity="Accion", mappedBy="hallazgo")
     */

    private $acciones;

    

    public function __construct() {
        $this->auditoriasUsuarios = new ArrayCollection();
        $this->acciones = new ArrayCollection();
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Hallazgo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaHallazgo
     *
     * @param \DateTime $fechaHallazgo
     *
     * @return Hallazgo
     */
    public function setFechaHallazgo($fechaHallazgo)
    {
        $this->fechaHallazgo = $fechaHallazgo;

        return $this;
    }

    /**
     * Get fechaHallazgo
     *
     * @return \DateTime
     */
    public function getFechaHallazgo()
    {
        return $this->fechaHallazgo;
    }

    /**
     * Set naturaleza
     *
     * @param string $naturaleza
     *
     * @return Hallazgo
     */
    public function setNaturaleza($naturaleza)
    {
        $this->naturaleza = $naturaleza;

        return $this;
    }

    /**
     * Get naturaleza
     *
     * @return string
     */
    public function getNaturaleza()
    {
        return $this->naturaleza;
    }

    /**
     * Set tratamiento
     *
     * @param string $tratamiento
     *
     * @return Hallazgo
     */
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get tratamiento
     *
     * @return string
     */
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set auditoria
     *
     * @param \AppBundle\Entity\Auditoria $auditoria
     *
     * @return Hallazgo
     */
    public function setAuditoria(\AppBundle\Entity\Auditoria $auditoria = null)
    {
        $this->auditoria = $auditoria;

        return $this;
    }

    /**
     * Get auditoria
     *
     * @return \AppBundle\Entity\Auditoria
     */
    public function getAuditoria()
    {
        return $this->auditoria;
    }

    /**
     * Set tipohallazgo
     *
     * @param \AppBundle\Entity\TipoHallazgo $tipohallazgo
     *
     * @return Hallazgo
     */
    public function setTipohallazgo(\AppBundle\Entity\TipoHallazgo $tipohallazgo = null)
    {
        $this->tipohallazgo = $tipohallazgo;

        return $this;
    }

    /**
     * Get tipohallazgo
     *
     * @return \AppBundle\Entity\TipoHallazgo
     */
    public function getTipohallazgo()
    {
        return $this->tipohallazgo;
    }

    /**
     * Add accione
     *
     * @param \AppBundle\Entity\Accion $accione
     *
     * @return Hallazgo
     */
    public function addAccione(\AppBundle\Entity\Accion $accione)
    {
        $this->acciones[] = $accione;

        return $this;
    }

    /**
     * Remove accione
     *
     * @param \AppBundle\Entity\Accion $accione
     */
    public function removeAccione(\AppBundle\Entity\Accion $accione)
    {
        $this->acciones->removeElement($accione);
    }

    /**
     * Get acciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAcciones()
    {
        return $this->acciones;
    }
}
