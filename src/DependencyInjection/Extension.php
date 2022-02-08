<?php

namespace Cript\BlogBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension as BaseExtension;

class Extension extends BaseExtension implements PrependExtensionInterface
{
    public const ALIAS = 'cript_blog';

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $config = $this->processConfiguration($this->getConfiguration($configs, $container), $configs);

        $loader->load('services.xml');

        $container->getDefinition('cript_blog.post.repository')->setArgument('$postsPath', $config['posts_path']);

//        $this->configureMessenger($config['messenger'], $container);
    }

    public function getAlias()
    {
        return self::ALIAS;
    }

    public function prepend(ContainerBuilder $container)
    {
        $messengerConfig = [
            'messenger' => [
                'buses' => [
                    self::queryBusName() => []
                ]
            ]
        ];

        $container->prependExtensionConfig('framework', $messengerConfig);
    }

    public static function queryBusName(): string
    {
        return sprintf('%s_query_bus', self::ALIAS);
    }

//    private function configureMessenger(array $config, ContainerBuilder $container)
//    {
//        $queryBusAttributes = ['bus' => $config['query_bus']];
//        $queryBusService = new Reference($config['query_bus']);
//
//        $commandBusAttributes = ['bus' => $config['command_bus']];
//        $commandBusService = new Reference($config['command_bus']);
//
//        $container->getDefinition('axioma_cryptopsp_common.messenger.command_bus_sync')
//            ->addArgument($commandBusService);
//        $container->getDefinition('axioma_cryptopsp_common.messenger.query_bus')
//            ->addArgument($queryBusService);
//
//        $container->registerForAutoconfiguration(CommandHandlerInterface::class)
//            ->addTag('messenger.message_handler', $commandBusAttributes);
//        $container->registerForAutoconfiguration(QueryHandlerInterface::class)
//            ->addTag('messenger.message_handler', $queryBusAttributes);
//    }
}
