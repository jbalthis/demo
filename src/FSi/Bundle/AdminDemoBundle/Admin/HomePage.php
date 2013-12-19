<?php

namespace FSi\Bundle\AdminDemoBundle\Admin;

use FSi\Bundle\AdminBundle\Admin\Doctrine\ResourceElement;

class HomePage extends ResourceElement
{
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
        return 'demo.admin.homepage.name';
    }

    public function getClassName()
    {
        return 'FSi\Bundle\AdminDemoBundle\Entity\Resource';
    }
}