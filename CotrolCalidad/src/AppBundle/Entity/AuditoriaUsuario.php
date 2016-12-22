<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuditoriaUsuario
 *
 * @ORM\Table(name="auditoria_usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AuditoriaUsuarioRepository")
 */
class AuditoriaUsuario
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
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="auditoriasUsuarios")
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Auditoria", inversedBy="auditoriasUsuarios")
     */
    protected $auditoria;


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
     * Set role
     *
     * @param string $role
     *
     * @return AuditoriaUsuario
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return AuditoriaUsuario
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
     * Set auditoria
     *
     * @param \AppBundle\Entity\Auditoria $auditoria
     *
     * @return AuditoriaUsuario
     */
    public function setAuditoria(\AppBundle\Entity\Auditoria $auditoria = null)
    {
        $this->auditoria = $auditoria;

        return $this;
    }

    /**
     * Get auditoria
     *
     * @return \AppBundle\Entity\Auditoria
     */
    public function getAuditoria()
    {
        return $this->auditoria;
    }
}
