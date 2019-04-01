<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="follow")
 */
class Follow
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @var integer
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="usuarioSeguido")
     *
     * @var User
     */
    protected $usuario;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="seguidor")
     *
     * @var User
     */
    protected $seguidor;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    protected $fecha;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function getUsuario(): User
    {
        return $this->usuario;
    }

    /**
     * @param User $usuario
     */
    public function setUsuario(User $usuario): void
    {
        $this->usuario = $usuario;
    }

    /**
     * @return User
     */
    public function getSeguidor(): User
    {
        return $this->seguidor;
    }

    /**
     * @param User $seguidor
     */
    public function setSeguidor(User $seguidor): void
    {
        $this->seguidor = $seguidor;
    }

    /**
     * @return \DateTime
     */
    public function getFecha(): \DateTime
    {
        return $this->fecha;
    }

    /**
     * @param \DateTime $fecha
     */
    public function setFecha(\DateTime $fecha): void
    {
        $this->fecha = $fecha;
    }

}