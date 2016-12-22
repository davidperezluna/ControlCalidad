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
     * @ORM\Column(name="observaciones", type="text")
     */
    private $observaciones;


     /**
     * @ORM\OneToOne(targetEntity="CierreAuditoria", mappedBy="accion")
     *@ORM\joinColumn(name="cierre_auditoria_id", referencedColumnName="id")
     */
    private $cierre;


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
    public function setObservaciones($observaciones)
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
}
