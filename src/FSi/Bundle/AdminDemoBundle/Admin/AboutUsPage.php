<?php

namespace FSi\Bundle\AdminDemoBundle\Admin;

use FSi\Bundle\AdminBundle\Admin\Doctrine\ResourceElement;

class AboutUsPage extends ResourceElement
{
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