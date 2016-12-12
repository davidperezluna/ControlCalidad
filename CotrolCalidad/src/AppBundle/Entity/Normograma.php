<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Normograma
 *
 * @ORM\Table(name="normograma")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NormogramaRepository")
 */
class Normograma
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
     * @ORM\ManyToOne(targetEntity="DocumentoLegal", inversedBy="normogramas")
     */
    protected $documentoLegal;
    /**
     * @ORM\ManyToOne(targetEntity="Procedimiento", inversedBy="normogramas")
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
     * Set documentoLegal
     *
     * @param \AppBundle\Entity\DocumentoLegal $documentoLegal
     *
     * @return Normograma
     */
    public function setDocumentoLegal(\AppBundle\Entity\DocumentoLegal $documentoLegal = null)
    {
        $this->documentoLegal = $documentoLegal;

        return $this;
    }

    /**
     * Get documentoLegal
     *
     * @return \AppBundle\Entity\DocumentoLegal
     */
    public function getDocumentoLegal()
    {
        return $this->documentoLegal;
    }

    /**
     * Set procedimiento
     *
     * @param \AppBundle\Entity\Procedimiento $procedimiento
     *
     * @return Normograma
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
}
