<?php

namespace FSi\Bundle\AdminDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadAboutUsPageData implements FixtureInterface, ContainerAwareInterface
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
            ->get('resources.about_us_page.photo');

        $image = $generator->image(sys_get_temp_dir(), 800, 600);
        $resource->setFileValue(new UploadedFile($image, 'image.jpg', null, null, null, true));
        $manager->persist($resource);
        $manager->flush();

        unlink($image);

        $resource = $this->container->get('fsi_resource_repository.entity.repository')
            ->get('resources.about_us_page.content');

        $resource->setTextValue($generator->text(1000));
        $manager->persist($resource);
        $manager->flush();
    }
}