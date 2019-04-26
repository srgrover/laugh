<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="decimal", nullable=true, precision=7, scale=1)
     */
    protected $karma = 0;

    /**
     * @ORM\Column(type="decimal", nullable=true, precision=7, scale=1)
     */
    protected $rating = 0;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $register_at;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $born;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $gender;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $admin = false;

    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     */
    protected $posts;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author")
     */
    protected $comments;


    public function generateDate(){
        return new \DateTime('now');
    }

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->register_at = new \DateTime('now');
    }

    public function getRoles()
    {
        $roles = ["ROLE_USER"];     //Todos los usuarios son ROLE_USER
        if($this->isAdmin()){
            $roles[] = "ROLE_ADMIN";
        }
        return $roles;
    }

    /**
     * @return mixed
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getKarma()
    {
        return $this->karma;
    }

    /**
     * @param mixed $karma
     */
    public function setKarma($karma): void
    {
        $this->karma = $karma;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts): void
    {
        $this->posts = $posts;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return mixed
     */
    public function getRegisterAt()
    {
        return $this->register_at;
    }

    /**
     * @param mixed $register_at
     */
    public function setRegisterAt($register_at): void
    {
        $this->register_at = $register_at;
    }

    /**
     * @return mixed
     */
    public function getBorn()
    {
        return $this->born;
    }

    /**
     * @param mixed $born
     */
    public function setBorn($born): void
    {
        $this->born = $born;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }



}
