<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Tests\App;

use Cript\BlogBundle\CriptBlogBundle;
use FriendsOfBehat\SymfonyExtension\Bundle\FriendsOfBehatSymfonyExtensionBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    public function __construct($environment, $debug)
    {
        parent::__construct($environment, $debug);
    }

    public function registerBundles(): iterable
    {
        return [
            new FrameworkBundle(),
            new FriendsOfBehatSymfonyExtensionBundle(),
            new CriptBlogBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
//        $loader->load(__DIR__.'/config/'.$this->environment.'.yml');
        $loader->load(__DIR__.'/config/config.yml');
    }

    public function getCacheDir(): string
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') .
            DIRECTORY_SEPARATOR . 'cache' .
            DIRECTORY_SEPARATOR . Kernel::VERSION .
            DIRECTORY_SEPARATOR . $this->environment;
    }

    public function getLogDir(): string
    {
        return realpath(__DIR__ . DIRECTORY_SEPARATOR . '..') .
            DIRECTORY_SEPARATOR . 'cache' .
            DIRECTORY_SEPARATOR . Kernel::VERSION .
            DIRECTORY_SEPARATOR . $this->environment;
    }
}
