---
title: Fusce blandit risus
slug: fusce-blandit-risus
published: 0
date: 2022-01-15 19:24:00
---

#Fusce blandit risus

Donec dictum eget leo et imperdiet. Sed in leo convallis, pulvinar magna id, posuere risus. Maecenas risus dolor, molestie et tellus eget, posuere dapibus turpis. Cras in mi et ex pretium cursus. Donec scelerisque tempor urna, ut porta felis auctor et. Fusce scelerisque hendrerit elit, eget hendrerit quam pretium at. Sed interdum magna a lectus vestibulum, at blandit lorem ornare. Sed tristique neque lectus, vel blandit risus pretium eu. Pellentesque id tincidunt velit. Morbi id urna imperdiet, suscipit orci tristique, commodo nulla.

```php
<?php

namespace Cript\BlogBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class CriptBlogExtension extends Extension
{
    public const ALIAS = 'cript_blog';

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $config = $this->processConfiguration($this->getConfiguration($configs, $container), $configs);

        $loader->load('services.xml');

        $container->getDefinition('cript_blog.post.repository')->setArgument('$postsPath', $config['posts_path']);
    }
}
```

Proin sed lacinia est. Praesent volutpat dui ac ipsum iaculis congue. Aliquam laoreet turpis eget arcu dictum accumsan. Donec finibus, nunc in sagittis rhoncus, ex dolor accumsan elit, eu ullamcorper mauris neque sed magna. Cras feugiat porta felis, et rutrum metus elementum viverra. Donec sed sem eget sapien interdum semper sed et risus. Mauris consectetur leo sed libero posuere, eu pharetra eros porta. Donec et dapibus mi, eget elementum nunc. Pellentesque id eleifend dui, eget feugiat urna. Nullam tempor lectus a pulvinar volutpat. In urna velit, bibendum et egestas non, bibendum at lorem.




