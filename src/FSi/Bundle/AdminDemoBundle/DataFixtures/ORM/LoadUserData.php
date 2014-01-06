<?php

namespace FSi\Bundle\AdminDemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
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
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setEmail('admin@fsi-open.com');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_ADMIN'));
        $userManager->updateUser($user);

        $manager->persist($user);
        $manager->flush();

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setUsername('redactor');
        $user->setEmail('redactor@fsi-open.com');
        $user->setPlainPassword('redactor');
        $user->setEnabled(true);
        $user->setRoles(array('ROLE_REDACTOR'));
        $userManager->updateUser($user);

        $manager->persist($user);
        $manager->flush();
    }
}