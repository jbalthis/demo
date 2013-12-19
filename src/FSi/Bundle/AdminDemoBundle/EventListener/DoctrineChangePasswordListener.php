<?php

namespace FSi\Bundle\AdminDemoBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Registry;
use FSi\Bundle\AdminSecurityBundle\Event\ChangePasswordEvent;
use Symfony\Component\PropertyAccess\PropertyAccessor;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class DoctrineChangePasswordListener
{
    private $encoderFactory;
    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $registry;

    /**
     * @param Registry $registry
     * @param \Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface $encoderFactory
     */
    function __construct(Registry $registry, EncoderFactoryInterface $encoderFactory)
    {
        $this->registry = $registry;
        $this->encoderFactory = $encoderFactory;
    }

    public function onChangePassword(ChangePasswordEvent $event)
    {
        $user = $event->getUser();
        $objectManager = $this->registry->getManagerForClass(get_class($user));

        if (isset($objectManager)) {
            $encoder = $this->encoderFactory->getEncoder($user);
            $password = $encoder->encodePassword('admin', $user->getSalt());

            $accessor = new PropertyAccessor();
            $accessor->setValue($user, 'password', $password);

            $objectManager->persist($user);
            $objectManager->flush();
        }
        $event->stopPropagation();
    }
}