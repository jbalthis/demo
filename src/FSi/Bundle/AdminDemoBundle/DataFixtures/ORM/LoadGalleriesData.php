<?php

namespace FSi\Bundle\AdminDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use FSi\Bundle\AdminDemoBundle\Entity\Gallery;
use FSi\Bundle\AdminDemoBundle\Entity\News;
use FSi\Bundle\AdminDemoBundle\Entity\Photo;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadGalleriesData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        for ($i = 0; $i < 20; $i++) {

            $gallery = new Gallery();
            $gallery->setName($generator->name());
            $gallery->setDescription($generator->text());
            $gallery->setVisible($generator->boolean());

            $imagesPaths = array();
            for ($a = 0; $a < 20; $a++) {
                $imagePath = $generator->image(sys_get_temp_dir(), 800, 600);
                $photo = new Photo();
                $photo->setPhoto(new UploadedFile(
                    $imagePath,
                    basename($imagePath),
                    null,
                    null,
                    null,
                    true
                ));
                $photo->setGallery($gallery);
                $manager->persist($photo);
                $imagesPaths[] = $imagePath;
            }

            $manager->persist($gallery);
            $manager->flush();
            $manager->clear();
            array_map(function($path) {unlink($path);}, $imagesPaths);
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 3;
    }
}