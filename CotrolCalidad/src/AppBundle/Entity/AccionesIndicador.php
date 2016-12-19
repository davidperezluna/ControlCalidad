<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AccionesIndicador
 *
 * @ORM\Table(name="acciones_indicador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccionesIndicadorRepository")
 */
class AccionesIndicador
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
     * @ORM\Column(name="accion", type="text")
     */
    private $accion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCierre", type="date")
     */
    private $fechaCierre;

    /**
     * @ORM\ManyToOne(targetEntity="SeguimientoIndicador", inversedBy="accionesIndicadores")
     */
    protected $seguimientoIndicador;



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
     * Set accion
     *
     * @param string $accion
     *
     * @return AccionesIndicador
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
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     *
     * @return AccionesIndicador
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set seguimientoIndicador
     *
     * @param \AppBundle\Entity\SeguimientoIndicador $seguimientoIndicador
     *
     * @return AccionesIndicador
     */
    public function setSeguimientoIndicador(\AppBundle\Entity\SeguimientoIndicador $seguimientoIndicador = null)
    {
        $this->seguimientoIndicador = $seguimientoIndicador;

        return $this;
    }

    /**
     * Get seguimientoIndicador
     *
     * @return \AppBundle\Entity\SeguimientoIndicador
     */
    public function getSeguimientoIndicador()
    {
        return $this->seguimientoIndicador;
    }
}
