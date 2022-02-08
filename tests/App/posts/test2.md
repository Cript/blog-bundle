---
title: Sed sollicitudin
slug: sed-sollicitudin
published: 1
date: 2022-01-16 14:36:00
---

#Sed sollicitudin

Sed sollicitudin, nibh vestibulum feugiat imperdiet, risus ligula gravida nisl, nec imperdiet sem quam nec neque. Donec eleifend, sem eu tempus volutpat, tellus augue egestas justo, a sodales quam nibh ac dolor. Nullam id laoreet lacus. Pellentesque dignissim pharetra tristique. Suspendisse vehicula dictum odio varius vulputate. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nullam ac quam euismod lorem hendrerit suscipit nec ac mauris. Donec et purus consectetur purus feugiat sodales sit amet sed urna. Nam eget nibh vitae nisl commodo interdum ut sed sapien.

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

Nunc non purus tristique, euismod felis vel, auctor est. Proin interdum neque turpis, in sollicitudin tortor ultrices eget. Quisque varius viverra dolor, eu pretium massa rutrum non. Sed vehicula risus eget ex efficitur, in lacinia ipsum pulvinar. Sed in lacinia ex. Quisque porta elit et tellus venenatis mollis. Fusce vehicula rhoncus mi sit amet pretium. Proin tristique, eros a auctor dignissim, velit eros congue dui, in placerat leo sapien id purus. Curabitur malesuada risus non luctus rhoncus. Vivamus quis enim velit. Donec lacinia justo sapien.

Nulla iaculis sem lorem. Praesent laoreet augue vel turpis auctor lobortis. Sed vitae tellus est. Aliquam erat velit, tempor vel erat sed, efficitur interdum risus. Phasellus et euismod felis. Etiam ac quam tincidunt, congue nisi vel, ullamcorper sem. Sed mollis molestie risus eu lacinia.

Sed ornare, augue et congue faucibus, leo neque euismod ex, ut gravida tortor orci eget lorem. Quisque non odio et massa aliquet venenatis. Morbi fringilla, turpis sed tristique gravida, lacus libero sagittis tortor, sed mattis quam mi non lectus. Cras rhoncus urna id dolor faucibus, non pulvinar ex rhoncus. Nunc interdum lacus iaculis sapien porttitor ornare ac ut justo. Morbi id ornare metus, malesuada eleifend dolor. Donec ac lacus dui. Nullam ut felis vel diam fringilla pulvinar id in mi. Vivamus et elit tellus. Integer fermentum blandit condimentum. Aenean nisi est, maximus vitae ligula eget, dictum posuere sapien.




