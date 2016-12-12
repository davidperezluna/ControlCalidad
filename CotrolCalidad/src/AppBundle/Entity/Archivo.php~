<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Archivo
 *
 * @ORM\Table(name="archivo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArchivoRepository")
 */
class Archivo
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
     * @ORM\Column(name="version", type="string", length=255)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="urlDocumento", type="string", length=255)
     */
    private $urlDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="urlDocumentoPdf", type="string", length=255)
     */
    private $urlDocumentoPdf;

    /**
     * @ORM\ManyToOne(targetEntity="Proceso", inversedBy="archivos")
     */
    protected $proceso;
    /**
     * @ORM\ManyToOne(targetEntity="Procedimiento", inversedBy="archivos")
     */
    protected $procedimiento;





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
     * Set version
     *
     * @param string $version
     *
     * @return Archivo
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Archivo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Archivo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set urlDocumento
     *
     * @param string $urlDocumento
     *
     * @return Archivo
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
     * Set proceso
     *
     * @param \AppBundle\Entity\Proceso $proceso
     *
     * @return Archivo
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
     * Set procedimiento
     *
     * @param \AppBundle\Entity\Procedimiento $procedimiento
     *
     * @return Archivo
     */
    public function setProcedimiento(\AppBundle\Entity\Procedimiento $procedimiento = null)
    {
        $this->procedimiento = $procedimiento;

        return $this;
    }

    /**
     * Get procedimiento
     *
     * @return \AppBundle\Entity\Procedimiento
     */
    public function getProcedimiento()
    {
        return $this->procedimiento;
    }

    /**
     * Set urlDocumentoPdf
     *
     * @param string $urlDocumentoPdf
     *
     * @return Archivo
     */
    public function setUrlDocumentoPdf($urlDocumentoPdf)
    {
        $this->urlDocumentoPdf = $urlDocumentoPdf;

        return $this;
    }

    /**
     * Get urlDocumentoPdf
     *
     * @return string
     */
    public function getUrlDocumentoPdf()
    {
        return $this->urlDocumentoPdf;
    }
}
