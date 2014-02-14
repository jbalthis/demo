<?php

namespace FSi\Bundle\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\GalleryBundle\Model\Gallery as BaseGallery;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_gallery")
 */
class Gallery extends BaseGallery
{    /**
     * @ORM\OneToMany(targetEntity="FSi\Bundle\AdminDemoBundle\Entity\Photo",
     *      mappedBy="gallery", cascade={"persist"}, orphanRemoval=true, indexBy="id")
     * @Assert\Count(min = "1")
     */
    protected $photos;
}