<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Procedimiento
 *
 * @ORM\Table(name="procedimiento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProcedimientoRepository")
 */
class Procedimiento
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
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vigencia", type="string")
     */ 
    private $vigencia;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    
      /**
     * @ORM\ManyToOne(targetEntity="Proceso", inversedBy="procedminetos")
     */
    protected $proceso;

     /**
     * @ORM\OneToMany(targetEntity="ProcedimientoDocumento", mappedBy="procedimiento")
     */
    private $procedimientosDocumentos;

     /**
     * @ORM\OneToMany(targetEntity="ProcedimientoUsuario", mappedBy="procedimiento")
     */
    private $procedimientosUsuarios;

    /**
     * @ORM\OneToMany(targetEntity="Normograma", mappedBy="procedimiento")
     */
    private $normogramas;

    public function __construct() {
        $this->procedimientosDocumentos = new ArrayCollection();
        $this->procedimientosUsuarios = new ArrayCollection();
        $this->normogramas = new ArrayCollection();
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
     * @param string $codigo
     *
     * @return Procedimiento
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
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
     * @return Procedimiento
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
     * Set vigencia
     *
     * @param \DateTime $vigencia
     *
     * @return Procedimiento
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
     * Set version
     *
     * @param string $version
     *
     * @return Procedimiento
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
     * Set proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     *
     * @return Procedimiento
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
     * Add procedimientosDocumento
     *
     * @param \AppBundle\Entity\ProcedimientoDocumento $procedimientosDocumento
     *
     * @return Procedimiento
     */
    public function addProcedimientosDocumento(\AppBundle\Entity\ProcedimientoDocumento $procedimientosDocumento)
    {
        $this->procedimientosDocumentos[] = $procedimientosDocumento;

        return $this;
    }

    /**
     * Remove procedimientosDocumento
     *
     * @param \AppBundle\Entity\ProcedimientoDocumento $procedimientosDocumento
     */
    public function removeProcedimientosDocumento(\AppBundle\Entity\ProcedimientoDocumento $procedimientosDocumento)
    {
        $this->procedimientosDocumentos->removeElement($procedimientosDocumento);
    }

    /**
     * Get procedimientosDocumentos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcedimientosDocumentos()
    {
        return $this->procedimientosDocumentos;
    }

    /**
     * Add procedimientosUsuario
     *
     * @param \AppBundle\Entity\ProcedimientoUsuario $procedimientosUsuario
     *
     * @return Procedimiento
     */
    public function addProcedimientosUsuario(\AppBundle\Entity\ProcedimientoUsuario $procedimientosUsuario)
    {
        $this->procedimientosUsuarios[] = $procedimientosUsuario;

        return $this;
    }

    /**
     * Remove procedimientosUsuario
     *
     * @param \AppBundle\Entity\ProcedimientoUsuario $procedimientosUsuario
     */
    public function removeProcedimientosUsuario(\AppBundle\Entity\ProcedimientoUsuario $procedimientosUsuario)
    {
        $this->procedimientosUsuarios->removeElement($procedimientosUsuario);
    }

    /**
     * Get procedimientosUsuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProcedimientosUsuarios()
    {
        return $this->procedimientosUsuarios;
    }

    /**
     * Add normograma
     *
     * @param \AppBundle\Entity\Normograma $normograma
     *
     * @return Procedimiento
     */
    public function addNormograma(\AppBundle\Entity\Normograma $normograma)
    {
        $this->normogramas[] = $normograma;

        return $this;
    }

    /**
     * Remove normograma
     *
     * @param \AppBundle\Entity\Normograma $normograma
     */
    public function removeNormograma(\AppBundle\Entity\Normograma $normograma)
    {
        $this->normogramas->removeElement($normograma);
    }

    /**
     * Get normogramas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNormogramas()
    {
        return $this->normogramas;
    }
}
