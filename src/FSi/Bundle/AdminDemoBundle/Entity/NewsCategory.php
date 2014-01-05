<?php

namespace FSi\Bundle\AdminDemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FSi\DoctrineExtensions\Uploadable\Mapping\Annotation as FSi;
use Symfony\Component\Validator\Constraints as Assert;
use FSi\Bundle\DoctrineExtensionsBundle\Validator\Constraints as FSiAssert;

/**
 * @ORM\Entity
 * @ORM\Table(name="news_category")
 */
class NewsCategory
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = "5",
     *      max = "255"
     * )
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(
     *      max = "500"
     * )
     */
    protected $description;

    /**
     * @ORM\OneToMany(targetEntity="News", mappedBy="category", fetch="EXTRA_LAZY", orphanRemoval=true)
     */
    protected $news;

    public function __construct()
    {
        $this->news = new ArrayCollection();
    }

    /**
     * @return string
     */
    function __toString()
    {
        return $this->name;
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
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return bool
     */
    public function getNewsCount()
    {
        return $this->news->count();
    }

    /**
     * @return News[]
     */
    public function getNews()
    {
        return $this->name;
    }
}