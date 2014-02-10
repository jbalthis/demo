<?php

namespace FSi\Bundle\AdminDemoBundle\Admin;

use FSi\Bundle\AdminBundle\Doctrine\Admin\ResourceElement;
use FSi\Bundle\AdminSecurityBundle\Admin\SecuredElementInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

class AboutUsPage extends ResourceElement implements SecuredElementInterface
{
    public function isAllowed(SecurityContextInterface $securityContext)
    {
        return $securityContext->isGranted('ROLE_REDACTOR');
    }

    public function getId()
    {
        return 'about_us_page';
    }

    public function getKey()
    {
        return 'resources.about_us_page';
    }

    public function getName()
    {
        return 'demo.admin.about_us_page.name';
    }

    public function getClassName()
    {
        return 'FSi\Bundle\AdminDemoBundle\Entity\Resource';
    }
}