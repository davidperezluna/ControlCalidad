<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Documento
 *
 * @ORM\Table(name="documento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DocumentoRepository")
 */
class Documento
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="urlDocumento", type="string", length=255)
     */
    private $urlDocumento;

    /**
     * @ORM\ManyToOne(targetEntity="TipoDocumento", inversedBy="tiposDocuemntos")
     */
    protected $tipoDocumento;

    /**
     * @ORM\OneToMany(targetEntity="ProcedimientoDocumento", mappedBy="documento")
     */
    private $procedimientosDocumentos;

    public function __construct() {
        $this->procedimientosDocumentos = new ArrayCollection();
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
     * @return Documento
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
     * Set urlDocumento
     *
     * @param string $urlDocumento
     *
     * @return Documento
     */
    public function setUrlDocumento($urlDocumento)
    {
        $this->urlDocumento = $urlDocumento;

        return $this;
    }

    /**
     * Get urlDocumento
     *
     * @return string
     */
    public function getUrlDocumento()
    {
        return $this->urlDocumento;
    }

    /**
     * Set tipoDocumento
     *
     * @param \AppBundle\Entity\TipoDocumento $tipoDocumento
     *
     * @return Documento
     */
    public function setTipoDocumento(\AppBundle\Entity\TipoDocumento $tipoDocumento = null)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return \AppBundle\Entity\TipoDocumento
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Add procedimientosDocumento
     *
     * @param \AppBundle\Entity\ProcedimientoDocumento $procedimientosDocumento
     *
     * @return Documento
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
}
