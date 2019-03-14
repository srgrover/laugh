<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
/**
 * @ORM\Entity(repositoryClass="App\Entity\UserRepository")
 * @ORM\Table(name="comment")
 */
class Comment
{
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('user', new NotBlank(array(
            'message' => 'Debes introducir tu nombre'
        )));
        $metadata->addPropertyConstraint('comment', new NotBlank(array(
            'message' => 'Debes introducir un comentario'
        )));
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $user;
    /**
     * @ORM\Column(type="text")
     */
    protected $comments;
    /**
     * @ORM\Column(type="boolean")
     */
    protected $approved;
    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     */
    protected $post;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;
    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
        $this->setApproved(true);
    }
    /**
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
        $this->setUpdated(new \DateTime());
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set user
     *
     * @param string $user
     *
     * @return Comment
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return Comment
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }
    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * Set approved
     *
     * @param boolean $approved
     *
     * @return Comment
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
        return $this;
    }
    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }
    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Comment
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }
    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }
    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Comment
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    /**
     * Set post
     *
     * @param Post $post
     *
     * @return Comment
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;
        return $this;
    }
    /**
     * Get post
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }
}