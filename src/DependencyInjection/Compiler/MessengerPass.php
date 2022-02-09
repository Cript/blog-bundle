<?php

namespace Cript\BlogBundle\DependencyInjection\Compiler;

use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryHandlerInterface;
use Cript\BlogBundle\DependencyInjection\Configuration;
use Cript\BlogBundle\DependencyInjection\Extension;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection;

class MessengerPass implements DependencyInjection\Compiler\CompilerPassInterface
{
    private const TAG_NAME = 'messenger.message_handler';
    private const CRIPT_BLOG_QUERY_HANDLER_TAG_NAME = 'messenger.query_handler';

    public function process(DependencyInjection\ContainerBuilder $container)
    {
        $queryHandlers = $container->findTaggedServiceIds(self::CRIPT_BLOG_QUERY_HANDLER_TAG_NAME);

        foreach ($queryHandlers as $name => $handler) {
            $definition = $container->getDefinition($name);
            $this->processTags($definition, Extension::queryBusName());
        }
    }

    private function processTags(DependencyInjection\Definition $definition, string $busName)
    {
        $definition->clearTags();
        $definition->addTag(self::TAG_NAME, ['bus' => $busName]);
    }
}
