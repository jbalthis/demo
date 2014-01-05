<?php

namespace FSi\Bundle\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\DoctrineExtensions\Uploadable\Mapping\Annotation as FSi;
use Symfony\Component\Validator\Constraints as Assert;
use FSi\Bundle\DoctrineExtensionsBundle\Validator\Constraints as FSiAssert;

/**
 * @ORM\Entity
 * @ORM\Table(name="news")
 */
class News
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(
     *      min = "5",
     *      max = "100"
     * )
     */
    protected $title;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $visible;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Assert\DateTime()
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="text", name="creator_email")
     * @Assert\Email()
     */
    protected $creatorEmail;

    /**
     * @ORM\Column(length=255, nullable=true, name="photo_key")
     * @FSi\Uploadable(targetField="photo")
     */
    protected $photoKey;

    /**
     * @FSiAssert\Image(
     *     minWidth = 800,
     *     minHeight = 600
     * )
     */
    protected $photo;

    /**
     * @ORM\ManyToOne(targetEntity="NewsCategory", inversedBy="news")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     * @Assert\NotNull()
     */
    protected $category;

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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $creatorEmail
     */
    public function setCreatorEmail($creatorEmail)
    {
        $this->creatorEmail = $creatorEmail;
    }

    /**
     * @return mixed
     */
    public function getCreatorEmail()
    {
        return $this->creatorEmail;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $visible
     * @return News
     */
    public function setVisible($visible)
    {
        $this->visible = (boolean) $visible;
    }

    /**
     * @return mixed
     */
    public function isVisible()
    {
        return $this->visible;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photoKey
     */
    public function setPhotoKey($photoKey)
    {
        $this->photoKey = $photoKey;
    }

    /**
     * @return mixed
     */
    public function getPhotoKey()
    {
        return $this->photoKey;
    }

    /**
     * @param NewsCategory $category
     */
    public function setCategory(NewsCategory $category)
    {
        $this->category = $category;
    }

    /**
     * @return NewsCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
}