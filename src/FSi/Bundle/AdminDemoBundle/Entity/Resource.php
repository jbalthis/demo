<?php

namespace FSi\Bundle\AdminDemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FSi\Bundle\ResourceRepositoryBundle\Model\ResourceFSiFile as BaseResource;

/**
 * @ORM\Entity(repositoryClass="FSi\Bundle\ResourceRepositoryBundle\Entity\ResourceRepository")
 * @ORM\Table(name="fsi_resource")
 */
class Resource extends BaseResource
{
}