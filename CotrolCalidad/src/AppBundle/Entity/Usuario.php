<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
{
    /**
     * @var string
     */
    private $salt;
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
     * @ORM\Column(name="nombres", type="string", length=255)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=255)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="string", length=255)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

     /**
     * @ORM\ManyToOne(targetEntity="Cargo", inversedBy="Usuarios")
     */
    protected $cargo;

    /**
     * @ORM\OneToMany(targetEntity="ProcesoUsuario", mappedBy="usuario")
     */
    private $procesosUsuarios;

    /**
     * @ORM\OneToMany(targetEntity="ProcedimientoUsuario", mappedBy="usuario")
     */
    private $procedimientosUsuarios;

     public function __construct() {
        $this->procesosUsuarios = new ArrayCollection();
        $this->procedimientosUsuarios = new ArrayCollection();
    }

    public function __toString()
{
    return (string) $this->getNombres()." ".$this->getApellidos()." ".$this->getIdentificacion();
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
     * Set nombres
     *
     * @param string $nombres
     *
     * @return Usuario
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Usuario
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Usuario
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Usuario
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
     * Set identificacion
     *
     * @param string $identificacion
     *
     * @return Usuario
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    function eraseCredentials()
    {
    }

     function getRoles()
    {
        $varRole=$this->getRole();
        return array($varRole);
    }

    function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Add procesosUsuario
     *
     * @param \AppBundle\Entity\ProcesoUsuario $procesosUsuario
     *
     * @return Usuario
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
     * Set cargo
     *
     * @param \AppBundle\Entity\Cargo $cargo
     *
     * @return Usuario
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
     * Add procedimientosUsuario
     *
     * @param \AppBundle\Entity\ProcedimientoUsuario $procedimientosUsuario
     *
     * @return Usuario
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
}
