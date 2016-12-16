<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Proceso
 *
 * @ORM\Table(name="proceso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProcesoRepository")
 */
class Proceso
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
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vigencia", type="string")
     */
    private $vigencia;

   

    /**
     * @ORM\ManyToOne(targetEntity="MacroProceso", inversedBy="procesos")
     */
    protected $macroProceso;

     /**
     * @ORM\OneToMany(targetEntity="Procedimiento", mappedBy="proceso")
     */
    private $procedimientos;

    /**
     * @ORM\OneToMany(targetEntity="Archivo", mappedBy="proceso")
     */
    private $archivos;

    /**
     * @ORM\OneToMany(targetEntity="Indicador", mappedBy="proceso")
     */

    private $indicadores;

    /**
     * @ORM\OneToMany(targetEntity="ProcesoUsuario", mappedBy="proceso")
     */
    private $procesosUsuarios;

    

    public function __construct() {
        $this->procedimientos = new ArrayCollection();
        $this->procesosUsuarios = new ArrayCollection();
        $this->indicadores = new ArrayCollection();
       
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
     * @return Proceso
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
     * Set version
     *
     * @param string $version
     *
     * @return Proceso
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set vigencia
     *
     * @param \DateTime $vigencia
     *
     * @return Proceso
     */
    public function setVigencia($vigencia)
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get vigencia
     *
     * @return \DateTime
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }

    /**
     * Set macroProceso
     *
     * @param \AppBundle\Entity\MacroProceso $macroProceso
     *
     * @return Proceso
     */
    public function setMacroProceso(\AppBundle\Entity\MacroProceso $macroProceso = null)
    {
        $this->macroProceso = $macroProceso;

        return $this;
    }

    /**
     * Get macroProceso
     *
     * @return \AppBundle\Entity\MacroProceso
     */
    public function getMacroProceso()
    {
        return $this->macroProceso;
    }

    /**
     * Add procedimiento
     *
     * @param \AppBundle\Entity\Procedimiento $procedimiento
     *
     * @return Proceso
     */
    public function addProcedimiento(\AppBundle\Entity\Procedimiento $procedimiento)
    {
        $this->procedimientos[] = $procedimiento;

        return $this;
    }

    /**
     * Remove procedimiento
     *
     * @param \AppBundle\Entity\Procedimiento $procedimiento
     */
    public function removeProcedimiento(\AppBundle\Entity\Procedimiento $procedimiento)
    {
        $this->procedimientos->removeElement($procedimiento);
    }

    /**
     * Get procedimientos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcedimientos()
    {
        return $this->procedimientos;
    }

    /**
     * Add procesosUsuario
     *
     * @param \AppBundle\Entity\ProcesoUsuario $procesosUsuario
     *
     * @return Proceso
     */
    public function addProcesosUsuario(\AppBundle\Entity\ProcesoUsuario $procesosUsuario)
    {
        $this->procesosUsuarios[] = $procesosUsuario;

        return $this;
    }

    /**
     * Remove procesosUsuario
     *
     * @param \AppBundle\Entity\ProcesoUsuario $procesosUsuario
     */
    public function removeProcesosUsuario(\AppBundle\Entity\ProcesoUsuario $procesosUsuario)
    {
        $this->procesosUsuarios->removeElement($procesosUsuario);
    }

    /**
     * Get procesosUsuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcesosUsuarios()
    {
        return $this->procesosUsuarios;
    }

    /**
     * Add archivo
     *
     * @param \AppBundle\Entity\Archivo $archivo
     *
     * @return Proceso
     */
    public function addArchivo(\AppBundle\Entity\Archivo $archivo)
    {
        $this->archivos[] = $archivo;

        return $this;
    }

    /**
     * Remove archivo
     *
     * @param \AppBundle\Entity\Archivo $archivo
     */
    public function removeArchivo(\AppBundle\Entity\Archivo $archivo)
    {
        $this->archivos->removeElement($archivo);
    }

    /**
     * Get archivos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Proceso
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
     * Add indicadore
     *
     * @param \AppBundle\Entity\Indicador $indicadore
     *
     * @return Proceso
     */
    public function addIndicadore(\AppBundle\Entity\Indicador $indicadore)
    {
        $this->indicadores[] = $indicadore;

        return $this;
    }

    /**
     * Remove indicadore
     *
     * @param \AppBundle\Entity\Indicador $indicadore
     */
    public function removeIndicadore(\AppBundle\Entity\Indicador $indicadore)
    {
        $this->indicadores->removeElement($indicadore);
    }

    /**
     * Get indicadores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIndicadores()
    {
        return $this->indicadores;
    }
}
