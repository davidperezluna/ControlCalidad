<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProcedimientoDocumento
 *
 * @ORM\Table(name="procedimiento_documento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProcedimientoDocumentoRepository")
 */
class ProcedimientoDocumento
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
     * @ORM\ManyToOne(targetEntity="Procedimiento", inversedBy="procedimientosDocumentos")
     */
    protected $procedimiento;

    /**
     * @ORM\ManyToOne(targetEntity="Documento", inversedBy="procedimientosDocumentos")
     */
    protected $documento;


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
     * Set procedimiento
     *
     * @param \AppBundle\Entity\Procedimiento $procedimiento
     *
     * @return ProcedimientoDocumento
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
     * Set documento
     *
     * @param \AppBundle\Entity\Documento $documento
     *
     * @return ProcedimientoDocumento
     */
    public function setDocumento(\AppBundle\Entity\Documento $documento = null)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return \AppBundle\Entity\Documento
     */
    public function getDocumento()
    {
        return $this->documento;
    }
}
