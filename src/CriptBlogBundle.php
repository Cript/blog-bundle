<?php

namespace Cript\BlogBundle;

use Cript\BlogBundle\DependencyInjection\Compiler\MessengerPass;
use Cript\BlogBundle\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CriptBlogBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new MessengerPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 10);
    }

    public function getContainerExtension()
    {
        return new Extension();
    }
}
