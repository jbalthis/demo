<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FSi\Bundle\AdminDemoBundle\FSiAdminDemoBundle(),
            new FSi\Bundle\WebBundle\FSiWebBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new Knp\Bundle\GaufretteBundle\KnpGaufretteBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new FSi\Bundle\FormExtensionsBundle\FSiFormExtensionsBundle(),
            new FSi\Bundle\DoctrineExtensionsBundle\FSiDoctrineExtensionsBundle(),
            new FSi\Bundle\ResourceRepositoryBundle\FSiResourceRepositoryBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new FSi\Bundle\DataSourceBundle\DataSourceBundle(),
            new FSi\Bundle\DataGridBundle\DataGridBundle(),
            new FSi\Bundle\AdminBundle\FSiAdminBundle(),
            new FSi\Bundle\AdminSecurityBundle\FSiAdminSecurityBundle(),

            new Liip\ImagineBundle\LiipImagineBundle(),
            new WhiteOctober\PagerfantaBundle\WhiteOctoberPagerfantaBundle(),

            new FSi\Bundle\GalleryBundle\FSiGalleryBundle(),
            new FSi\Bundle\AdminGalleryBundle\FSiAdminGalleryBundle(),

            new FSi\Bundle\NewsBundle\FSiNewsBundle(),
            new FSi\Bundle\AdminNewsBundle\FSiAdminNewsBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/fsi_demo/cache/'.$this->environment;
        }

        return parent::getCacheDir();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/fsi_demo/logs';
        }

        return parent::getLogDir();
    }

    /**
     * @return bool
     */
    private function isVagrantEnvironment()
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }
}
