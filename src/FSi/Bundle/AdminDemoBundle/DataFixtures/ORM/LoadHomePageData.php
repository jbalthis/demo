<?php

namespace FSi\Bundle\AdminDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadHomePageData implements FixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $generator = Factory::create();

        $resource = $this->container->get('fsi_resource_repository.entity.repository')
            ->get('resources.home_page.header');

        $resource->setTextValue($generator->text(150));
        $manager->persist($resource);
        $manager->flush();

        $resource = $this->container->get('fsi_resource_repository.entity.repository')
            ->get('resources.home_page.welcome_text');

        $resource->setTextValue($generator->text(1000));
        $manager->persist($resource);
        $manager->flush();
    }
}