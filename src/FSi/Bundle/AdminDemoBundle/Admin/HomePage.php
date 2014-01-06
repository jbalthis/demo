<?php

namespace FSi\Bundle\AdminDemoBundle\Admin;

use FSi\Bundle\AdminBundle\Admin\Doctrine\ResourceElement;
use FSi\Bundle\AdminSecurityBundle\Admin\SecuredElementInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class HomePage extends ResourceElement implements SecuredElementInterface
{
    public function isAllowed(SecurityContextInterface $securityContext)
    {
        return $securityContext->isGranted('ROLE_REDACTOR');
    }

    public function getId()
    {
        return 'home_page';
    }

    public function getKey()
    {
        return 'resources.home_page';
    }

    public function getName()
    {
        return 'demo.admin.home_page.name';
    }

    public function getClassName()
    {
        return 'FSi\Bundle\AdminDemoBundle\Entity\Resource';
    }
}