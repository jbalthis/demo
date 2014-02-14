<?php

namespace FSi\Bundle\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use FSi\Bundle\DoctrineExtensionsBundle\Validator\Constraints as FSiAssert;
use FSi\Bundle\GalleryBundle\Model\Photo as BasePhoto;

/**
 * @ORM\Entity
 * @ORM\Table(name="fsi_gallery_photo")
 */
class Photo extends BasePhoto
{
    /**
     * @FSiAssert\Image()
     * @Assert\NotBlank()
     */
    protected $photo;
}