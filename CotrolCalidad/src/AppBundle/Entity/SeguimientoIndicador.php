<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * SeguimientoIndicador
 *
 * @ORM\Table(name="seguimiento_indicador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeguimientoIndicadorRepository")
 */
class SeguimientoIndicador
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
     * @ORM\Column(name="fechaSeguimiento", type="date")
     */
    private $fechaSeguimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="proximaFecha", type="date")
     */
    private $proximaFecha;

    /**
     * @var int
     *
     * @ORM\Column(name="resultado", type="integer")
     */
    private $resultado;

    /**
     * @var bool
     *
     * @ORM\Column(name="notificacion", type="boolean")
     */
    private $notificacion;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="seguimientosIndicadores")
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Indicador", inversedBy="seguimientosIndicadores")
     */
    protected $indicador;

     /**
     * @ORM\OneToMany(targetEntity="AccionesIndicador", mappedBy="seguimientoIndicador")
     */
    private $accionesIndicadores;
    
    public function __construct() {
        $this->accionesIndicadores = new ArrayCollection();
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
     * Set fechaSeguimiento
     *
     * @param \DateTime $fechaSeguimiento
     *
     * @return SeguimientoIndicador
     */
    public function setFechaSeguimiento($fechaSeguimiento)
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    /**
     * Get fechaSeguimiento
     *
     * @return \DateTime
     */
    public function getFechaSeguimiento()
    {
        return $this->fechaSeguimiento;
    }

    /**
     * Set proximaFecha
     *
     * @param \DateTime $proximaFecha
     *
     * @return SeguimientoIndicador
     */
    public function setProximaFecha($proximaFecha)
    {
        $this->proximaFecha = $proximaFecha;

        return $this;
    }

    /**
     * Get proximaFecha
     *
     * @return \DateTime
     */
    public function getProximaFecha()
    {
        return $this->proximaFecha;
    }

    /**
     * Set resultado
     *
     * @param integer $resultado
     *
     * @return SeguimientoIndicador
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return int
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set notificacion
     *
     * @param boolean $notificacion
     *
     * @return SeguimientoIndicador
     */
    public function setNotificacion($notificacion)
    {
        $this->notificacion = $notificacion;

        return $this;
    }

    /**
     * Get notificacion
     *
     * @return bool
     */
    public function getNotificacion()
    {
        return $this->notificacion;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return SeguimientoIndicador
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set indicador
     *
     * @param \AppBundle\Entity\Indicador $indicador
     *
     * @return SeguimientoIndicador
     */
    public function setIndicador(\AppBundle\Entity\Indicador $indicador = null)
    {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return \AppBundle\Entity\Indicador
     */
    public function getIndicador()
    {
        return $this->indicador;
    }

    /**
     * Add accionesIndicadore
     *
     * @param \AppBundle\Entity\AccionesIndicador $accionesIndicadore
     *
     * @return SeguimientoIndicador
     */
    public function addAccionesIndicadore(\AppBundle\Entity\AccionesIndicador $accionesIndicadore)
    {
        $this->accionesIndicadores[] = $accionesIndicadore;

        return $this;
    }

    /**
     * Remove accionesIndicadore
     *
     * @param \AppBundle\Entity\AccionesIndicador $accionesIndicadore
     */
    public function removeAccionesIndicadore(\AppBundle\Entity\AccionesIndicador $accionesIndicadore)
    {
        $this->accionesIndicadores->removeElement($accionesIndicadore);
    }

    /**
     * Get accionesIndicadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAccionesIndicadores()
    {
        return $this->accionesIndicadores;
    }
}
