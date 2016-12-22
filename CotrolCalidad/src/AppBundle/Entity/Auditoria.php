<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Auditoria
 *
 * @ORM\Table(name="auditoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuditoriaRepository")
 */
class Auditoria
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
     * @ORM\Column(name="tipoAuditoria", type="string", length=255)
     */
    private $tipoAuditoria;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos", type="text")
     */
    private $objetivos;

    /**
     * @var string
     *
     * @ORM\Column(name="alcance", type="text")
     */
    private $alcance;

    /**
     * @var string
     *
     * @ORM\Column(name="criterio", type="text")
     */
    private $criterio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicio", type="date")
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFind", type="date")
     */
    private $fechaFind;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text" , nullable=true)
     */
    private $recomendaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="seguimiento", type="text" , nullable=true)
     */
    private $seguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="informe", type="text" , nullable=true)
     */
    private $informe;

    /**
     * @var string
     *
     * @ORM\Column(name="concluciones", type="text" , nullable=true)
     */
    private $concluciones;


    /**
     * @ORM\ManyToOne(targetEntity="Proceso", inversedBy="auditorias")
     */
    protected $proceso;


     /**
     * @ORM\OneToMany(targetEntity="AuditoriaUsuario", mappedBy="auditoria")
     */

    private $auditoriasUsuarios;

    /**
     * @ORM\OneToMany(targetEntity="Hallazgo", mappedBy="auditoria")
     */

    private $hallazgos;

    

    public function __construct() {
        $this->auditoriasUsuarios = new ArrayCollection();
        $this->hallazgos = new ArrayCollection();
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
     * Set tipoAuditoria
     *
     * @param string $tipoAuditoria
     *
     * @return Auditoria
     */
    public function setTipoAuditoria($tipoAuditoria)
    {
        $this->tipoAuditoria = $tipoAuditoria;

        return $this;
    }

    /**
     * Get tipoAuditoria
     *
     * @return string
     */
    public function getTipoAuditoria()
    {
        return $this->tipoAuditoria;
    }

    /**
     * Set objetivos
     *
     * @param string $objetivos
     *
     * @return Auditoria
     */
    public function setObjetivos($objetivos)
    {
        $this->objetivos = $objetivos;

        return $this;
    }

    /**
     * Get objetivos
     *
     * @return string
     */
    public function getObjetivos()
    {
        return $this->objetivos;
    }

    /**
     * Set alcance
     *
     * @param string $alcance
     *
     * @return Auditoria
     */
    public function setAlcance($alcance)
    {
        $this->alcance = $alcance;

        return $this;
    }

    /**
     * Get alcance
     *
     * @return string
     */
    public function getAlcance()
    {
        return $this->alcance;
    }

    /**
     * Set criterio
     *
     * @param string $criterio
     *
     * @return Auditoria
     */
    public function setCriterio($criterio)
    {
        $this->criterio = $criterio;

        return $this;
    }

    /**
     * Get criterio
     *
     * @return string
     */
    public function getCriterio()
    {
        return $this->criterio;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Auditoria
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFind
     *
     * @param \DateTime $fechaFind
     *
     * @return Auditoria
     */
    public function setFechaFind($fechaFind)
    {
        $this->fechaFind = $fechaFind;

        return $this;
    }

    /**
     * Get fechaFind
     *
     * @return \DateTime
     */
    public function getFechaFind()
    {
        return $this->fechaFind;
    }

    /**
     * Set recomendaciones
     *
     * @param string $recomendaciones
     *
     * @return Auditoria
     */
    public function setRecomendaciones($recomendaciones = null)
    {
        $this->recomendaciones = $recomendaciones;

        return $this;
    }

    /**
     * Get recomendaciones
     *
     * @return string
     */
    public function getRecomendaciones()
    {
        return $this->recomendaciones;
    }

    /**
     * Set seguimiento
     *
     * @param string $seguimiento
     *
     * @return Auditoria
     */
    public function setSeguimiento($seguimiento = null)
    {
        $this->seguimiento = $seguimiento;

        return $this;
    }

    /**
     * Get seguimiento
     *
     * @return string
     */
    public function getSeguimiento()
    {
        return $this->seguimiento;
    }

    /**
     * Set informe
     *
     * @param string $informe
     *
     * @return Auditoria
     */
    public function setInforme($informe = null)
    {
        $this->informe = $informe;

        return $this;
    }

    /**
     * Get informe
     *
     * @return string
     */
    public function getInforme()
    {
        return $this->informe;
    }

    /**
     * Set concluciones
     *
     * @param string $concluciones
     *
     * @return Auditoria
     */
    public function setConcluciones($concluciones = null)
    {
        $this->concluciones = $concluciones;

        return $this;
    }

    /**
     * Get concluciones
     *
     * @return string
     */
    public function getConcluciones()
    {
        return $this->concluciones;
    }

    /**
     * Set proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     *
     * @return Auditoria
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
     * Add auditoriasUsuario
     *
     * @param \AppBundle\Entity\AuditoriaUsuario $auditoriasUsuario
     *
     * @return Auditoria
     */
    public function addAuditoriasUsuario(\AppBundle\Entity\AuditoriaUsuario $auditoriasUsuario)
    {
        $this->auditoriasUsuarios[] = $auditoriasUsuario;

        return $this;
    }

    /**
     * Remove auditoriasUsuario
     *
     * @param \AppBundle\Entity\AuditoriaUsuario $auditoriasUsuario
     */
    public function removeAuditoriasUsuario(\AppBundle\Entity\AuditoriaUsuario $auditoriasUsuario)
    {
        $this->auditoriasUsuarios->removeElement($auditoriasUsuario);
    }

    /**
     * Get auditoriasUsuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuditoriasUsuarios()
    {
        return $this->auditoriasUsuarios;
    }

   

    /**
     * Add hallazgo
     *
     * @param \AppBundle\Entity\Hallazgo $hallazgo
     *
     * @return Auditoria
     */
    public function addHallazgo(\AppBundle\Entity\Hallazgo $hallazgo)
    {
        $this->hallazgos[] = $hallazgo;

        return $this;
    }

    /**
     * Remove hallazgo
     *
     * @param \AppBundle\Entity\Hallazgo $hallazgo
     */
    public function removeHallazgo(\AppBundle\Entity\Hallazgo $hallazgo)
    {
        $this->hallazgos->removeElement($hallazgo);
    }

    /**
     * Get hallazgos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHallazgos()
    {
        return $this->hallazgos;
    }
}
