<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IndicadorCargo
 *
 * @ORM\Table(name="indicador_cargo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\IndicadorCargoRepository")
 */
class IndicadorCargo
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @ORM\ManyToOne(targetEntity="Indicador", inversedBy="indicadoresCargos")
     */
    protected $indicador;

    /**
     * @ORM\ManyToOne(targetEntity="Cargo", inversedBy="indicadoresCargos")
     */
    protected $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="role_responsable", type="string", length=255)
     */
    private $roleResponsable;


    /**
     * Set cargo
     *
     * @param \AppBundle\Entity\Cargo $cargo
     *
     * @return IndicadorCargo
     */
    public function setCargo(\AppBundle\Entity\Cargo $cargo = null)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Get cargo
     *
     * @return \AppBundle\Entity\Cargo
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Set roleResponsable
     *
     * @param string $roleResponsable
     *
     * @return IndicadorCargo
     */
    public function setRoleResponsable($roleResponsable)
    {
        $this->roleResponsable = $roleResponsable;

        return $this;
    }

    /**
     * Get roleResponsable
     *
     * @return string
     */
    public function getRoleResponsable()
    {
        return $this->roleResponsable;
    }

    /**
     * Set indicador
     *
     * @param \AppBundle\Entity\Indicador $indicador
     *
     * @return IndicadorCargo
     */
    public function setIndicador(\AppBundle\Entity\Indicador $indicador = null)
    {
        $this->indicador = $indicador;

        return $this;
    }

    /**
     * Get indicador
     *
     * @return \AppBundle\Entity\Indicador
     */
    public function getIndicador()
    {
        return $this->indicador;
    }
}
