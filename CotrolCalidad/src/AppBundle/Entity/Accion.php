<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accion
 *
 * @ORM\Table(name="accion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccionRepository")
 */
class Accion
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
     * @ORM\Column(name="fechaMaxima", type="date")
     */
    private $fechaMaxima;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="text")
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @ORM\ManyToOne(targetEntity="Hallazgo", inversedBy="acciones")
     */
    protected $hallazgo;


     /**
     *@ORM\OneToOne(targetEntity="CierreAuditoria", mappedBy="accion")
     *@ORM\joinColumn(name="cierre_auditoria_id", referencedColumnName="id")
     */
    private $cierreAuditoria;


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
     * Set fechaMaxima
     *
     * @param \DateTime $fechaMaxima
     *
     * @return Accion
     */
    public function setFechaMaxima($fechaMaxima)
    {
        $this->fechaMaxima = $fechaMaxima;

        return $this;
    }

    /**
     * Get fechaMaxima
     *
     * @return \DateTime
     */
    public function getFechaMaxima()
    {
        return $this->fechaMaxima;
    }

    /**
     * Set accion
     *
     * @param string $accion
     *
     * @return Accion
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return Accion
     */
    public function setObservaciones($observaciones = null)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set hallazgo
     *
     * @param \AppBundle\Entity\Hallazgo $hallazgo
     *
     * @return Accion
     */
    public function setHallazgo(\AppBundle\Entity\Hallazgo $hallazgo = null)
    {
        $this->hallazgo = $hallazgo;

        return $this;
    }

    /**
     * Get hallazgo
     *
     * @return \AppBundle\Entity\Hallazgo
     */
    public function getHallazgo()
    {
        return $this->hallazgo;
    }

    /**
     * Set cierre
     *
     * @param \AppBundle\Entity\CierreAuditoria $cierre
     *
     * @return Accion
     */
    public function setCierre(\AppBundle\Entity\CierreAuditoria $cierre = null)
    {
        $this->cierre = $cierre;

        return $this;
    }

    /**
     * Get cierre
     *
     * @return \AppBundle\Entity\CierreAuditoria
     */
    public function getCierre()
    {
        return $this->cierre;
    }

    /**
     * Set cierreAuditoria
     *
     * @param \AppBundle\Entity\CierreAuditoria $cierreAuditoria
     *
     * @return Accion
     */
    public function setCierreAuditoria(\AppBundle\Entity\CierreAuditoria $cierreAuditoria = null)
    {
        $this->cierreAuditoria = $cierreAuditoria;

        return $this;
    }

    /**
     * Get cierreAuditoria
     *
     * @return \AppBundle\Entity\CierreAuditoria
     */
    public function getCierreAuditoria()
    {
        return $this->cierreAuditoria;
    }
}
