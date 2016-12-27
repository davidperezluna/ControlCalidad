<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Indicador
 *
 * @ORM\Table(name="indicador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndicadorRepository")
 */
class Indicador
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
     * @ORM\Column(name="codigo", type="integer")
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;


    /**
     * @var string
     *
     * @ORM\Column(name="calculoTotal", type="string", length=255)
     */
    private $calculoTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="medida", type="string", length=255)
     */
    private $medida;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="tablero", type="string", length=255)
     */
    private $tablero;
 
    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text")
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="pertinencia", type="string", length=255)
     */
    private $pertinencia;

    /**
     * @var string
     *
     * @ORM\Column(name="unidadMedida", type="string", length=255)
     */
    private $unidadMedida;

    /**
     * @var string
     *
     * @ORM\Column(name="metodolgia", type="string", length=255)
     */
    private $metodolgia;

    /**
     * @var string
     *
     * @ORM\Column(name="periodicidad", type="string", length=255)
     */
    private $periodicidad;

    /**
     * @var string
     *
     * @ORM\Column(name="lineaBase", type="string", length=255)
     */
    private $lineaBase;

    /**
     * @var int
     *
     * @ORM\Column(name="meta", type="integer")
     */
    private $meta;

     /**
     * @var int
     *
     * @ORM\Column(name="porcentaje_acciones", type="integer")
     */
    private $porcentajeAcciones;

     /**
     * @ORM\ManyToOne(targetEntity="Proceso", inversedBy="indicadores")
     */
    protected $proceso;

    /**
     * @ORM\ManyToOne(targetEntity="Rango", inversedBy="indicadores")
     */
    protected $rango;

    /**
     * @ORM\OneToMany(targetEntity="IndicadorCargo", mappedBy="indicador")
     */
    private $indicadoresCargos;

    /**
     * @ORM\OneToMany(targetEntity="Variable", mappedBy="indicador")
     */
    private $variables;

     /**
     * @ORM\OneToMany(targetEntity="SeguimientoIndicador", mappedBy="indicador")
     */
    private $seguimientosIndicadores;

     public function __construct() {
        $this->indicadoresCargos = new ArrayCollection();
        $this->variables = new ArrayCollection();
        $this->seguimientosIndicadores = new ArrayCollection();
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
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Indicador
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Indicador
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Indicador
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set tablero
     *
     * @param string $tablero
     *
     * @return Indicador
     */
    public function setTablero($tablero)
    {
        $this->tablero = $tablero;

        return $this;
    }

    /**
     * Get tablero
     *
     * @return string
     */
    public function getTablero()
    {
        return $this->tablero;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return Indicador
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set pertinencia
     *
     * @param string $pertinencia
     *
     * @return Indicador
     */
    public function setPertinencia($pertinencia)
    {
        $this->pertinencia = $pertinencia;

        return $this;
    }

    /**
     * Get pertinencia
     *
     * @return string
     */
    public function getPertinencia()
    {
        return $this->pertinencia;
    }

    /**
     * Set unidadMedida
     *
     * @param string $unidadMedida
     *
     * @return Indicador
     */
    public function setUnidadMedida($unidadMedida)
    {
        $this->unidadMedida = $unidadMedida;

        return $this;
    }

    /**
     * Get unidadMedida
     *
     * @return string
     */
    public function getUnidadMedida()
    {
        return $this->unidadMedida;
    }

    /**
     * Set metodolgia
     *
     * @param string $metodolgia
     *
     * @return Indicador
     */
    public function setMetodolgia($metodolgia)
    {
        $this->metodolgia = $metodolgia;

        return $this;
    }

    /**
     * Get metodolgia
     *
     * @return string
     */
    public function getMetodolgia()
    {
        return $this->metodolgia;
    }

    /**
     * Set periodicidad
     *
     * @param string $periodicidad
     *
     * @return Indicador
     */
    public function setPeriodicidad($periodicidad)
    {
        $this->periodicidad = $periodicidad;

        return $this;
    }

    /**
     * Get periodicidad
     *
     * @return string
     */
    public function getPeriodicidad()
    {
        return $this->periodicidad;
    }

    /**
     * Set lineaBase
     *
     * @param string $lineaBase
     *
     * @return Indicador
     */
    public function setLineaBase($lineaBase)
    {
        $this->lineaBase = $lineaBase;

        return $this;
    }

    /**
     * Get lineaBase
     *
     * @return string
     */
    public function getLineaBase()
    {
        return $this->lineaBase;
    }

    /**
     * Set meta
     *
     * @param integer $meta
     *
     * @return Indicador
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return integer
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set porcentajeAcciones
     *
     * @param integer $porcentajeAcciones
     *
     * @return Indicador
     */
    public function setPorcentajeAcciones($porcentajeAcciones)
    {
        $this->porcentajeAcciones = $porcentajeAcciones;

        return $this;
    }

    /**
     * Get porcentajeAcciones
     *
     * @return integer
     */
    public function getPorcentajeAcciones()
    {
        return $this->porcentajeAcciones;
    }

    /**
     * Set proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     *
     * @return Indicador
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
     * Set rango
     *
     * @param \AppBundle\Entity\Rango $rango
     *
     * @return Indicador
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
     * Add indicadoresCargo
     *
     * @param \AppBundle\Entity\IndicadorCargo $indicadoresCargo
     *
     * @return Indicador
     */
    public function addIndicadoresCargo(\AppBundle\Entity\IndicadorCargo $indicadoresCargo)
    {
        $this->indicadoresCargos[] = $indicadoresCargo;

        return $this;
    }

    /**
     * Remove indicadoresCargo
     *
     * @param \AppBundle\Entity\IndicadorCargo $indicadoresCargo
     */
    public function removeIndicadoresCargo(\AppBundle\Entity\IndicadorCargo $indicadoresCargo)
    {
        $this->indicadoresCargos->removeElement($indicadoresCargo);
    }

    /**
     * Get indicadoresCargos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIndicadoresCargos()
    {
        return $this->indicadoresCargos;
    }

    /**
     * Add variable
     *
     * @param \AppBundle\Entity\Variable $variable
     *
     * @return Indicador
     */
    public function addVariable(\AppBundle\Entity\Variable $variable)
    {
        $this->variables[] = $variable;

        return $this;
    }

    /**
     * Remove variable
     *
     * @param \AppBundle\Entity\Variable $variable
     */
    public function removeVariable(\AppBundle\Entity\Variable $variable)
    {
        $this->variables->removeElement($variable);
    }

    /**
     * Get variables
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * Add seguimientosIndicadore
     *
     * @param \AppBundle\Entity\SeguimientoIndicador $seguimientosIndicadore
     *
     * @return Indicador
     */
    public function addSeguimientosIndicadore(\AppBundle\Entity\SeguimientoIndicador $seguimientosIndicadore)
    {
        $this->seguimientosIndicadores[] = $seguimientosIndicadore;

        return $this;
    }

    /**
     * Remove seguimientosIndicadore
     *
     * @param \AppBundle\Entity\SeguimientoIndicador $seguimientosIndicadore
     */
    public function removeSeguimientosIndicadore(\AppBundle\Entity\SeguimientoIndicador $seguimientosIndicadore)
    {
        $this->seguimientosIndicadores->removeElement($seguimientosIndicadore);
    }

    /**
     * Get seguimientosIndicadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeguimientosIndicadores()
    {
        return $this->seguimientosIndicadores;
    }

    /**
     * Set calculoTotal
     *
     * @param string $calculoTotal
     *
     * @return Indicador
     */
    public function setCalculoTotal($calculoTotal)
    {
        $this->calculoTotal = $calculoTotal;

        return $this;
    }

    /**
     * Get calculoTotal
     *
     * @return string
     */
    public function getCalculoTotal()
    {
        return $this->calculoTotal;
    }

 

    /**
     * Set medida
     *
     * @param string $medida
     *
     * @return Indicador
     */
    public function setMedida($medida)
    {
        $this->medida = $medida;

        return $this;
    }

    /**
     * Get medida
     *
     * @return string
     */
    public function getMedida()
    {
        return $this->medida;
    }
}
