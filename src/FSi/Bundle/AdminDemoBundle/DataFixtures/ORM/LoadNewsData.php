<?php

namespace FSi\Bundle\AdminDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use FSi\Bundle\AdminDemoBundle\Entity\News;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadNewsData implements FixtureInterface, ContainerAwareInterface, OrderedFixtureInterface
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
        for ($i = 0; $i < 100; $i++) {
            $imagePath = $generator->image(sys_get_temp_dir(), 800, 600);
            $news = new News();
            $news->setCreatedAt($generator->dateTime());
            $news->setCreatorEmail($generator->email());
            $news->setTitle($generator->name());
            $news->setVisible($generator->boolean());
            $news->setPhoto(new UploadedFile(
                $imagePath,
                basename($imagePath),
                null,
                null,
                null,
                true
            ));

            $categories = $manager->getRepository('FSi\\Bundle\\AdminDemoBundle\\Entity\\NewsCategory')
                ->findAll();
            shuffle($categories);
            $category = current($categories);

            $news->setCategory($category);

            $manager->persist($news);
            $manager->flush();
            $manager->clear();
            unlink($imagePath);
        }
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2;
    }
}