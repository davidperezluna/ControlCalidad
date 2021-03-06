<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Riesgo
 *
 * @ORM\Table(name="riesgo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RiesgoRepository")
 */
class Riesgo
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
     * @ORM\Column(name="riesgo", type="text")
     */
    private $riesgo;

    /**
     * @var string
     *
     * @ORM\Column(name="accionPreventiva", type="text")
     */
    private $accionPreventiva;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;

    /**
     * @ORM\ManyToOne(targetEntity="Proceso", inversedBy="riesgos")
     */
    protected $proceso;


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
     * Set riesgo
     *
     * @param string $riesgo
     *
     * @return Riesgo
     */
    public function setRiesgo($riesgo)
    {
        $this->riesgo = $riesgo;

        return $this;
    }

    /**
     * Get riesgo
     *
     * @return string
     */
    public function getRiesgo()
    {
        return $this->riesgo;
    }

    /**
     * Set accionPreventiva
     *
     * @param string $accionPreventiva
     *
     * @return Riesgo
     */
    public function setAccionPreventiva($accionPreventiva)
    {
        $this->accionPreventiva = $accionPreventiva;

        return $this;
    }

    /**
     * Get accionPreventiva
     *
     * @return string
     */
    public function getAccionPreventiva()
    {
        return $this->accionPreventiva;
    }

    /**
     * Set proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     *
     * @return Riesgo
     */
    public function setProceso(\AppBundle\Entity\Proceso $proceso = null)
    {
        $this->proceso = $proceso;

        return $this;
    }

    /**
     * Get proceso
     *
     * @return \AppBundle\Entity\Proceso
     */
    public function getProceso()
    {
        return $this->proceso;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Riesgo
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}
