<?php

namespace Cript\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(Extension::ALIAS);
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('posts_path')
                    ->isRequired()
                ->end()
//                ->arrayNode('messenger')
//                    ->isRequired()
//                    ->children()
//                        ->scalarNode('command_bus')
//                            ->isRequired()
//                            ->cannotBeEmpty()
//                        ->end()
//                        ->scalarNode('query_bus')
//                            ->isRequired()
//                            ->cannotBeEmpty()
//                        ->end()
//                    ->end()
//                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
