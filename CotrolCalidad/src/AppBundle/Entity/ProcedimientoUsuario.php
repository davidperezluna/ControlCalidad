<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProcedimientoUsuario
 *
 * @ORM\Table(name="procedimiento_usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProcedimientoUsuarioRepository")
 */
class ProcedimientoUsuario
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
     * @ORM\ManyToOne(targetEntity="Procedimiento", inversedBy="procedimientosUsuarios")
     */
    protected $procedimiento;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="procedimientosUsuarios")
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Role", inversedBy="procedimientosUsuarios")
     */
    protected $role;


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
     * @return ProcedimientoUsuario
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
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return ProcedimientoUsuario
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set role
     *
     * @param \AppBundle\Entity\Role $role
     *
     * @return ProcedimientoUsuario
     */
    public function setRole(\AppBundle\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \AppBundle\Entity\Role
     */
    public function getRole()
    {
        return $this->role;
    }
}
