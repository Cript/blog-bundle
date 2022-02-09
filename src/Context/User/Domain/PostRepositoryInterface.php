<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Context\User\Domain;

use Cript\BlogBundle\Context\User\Application\PostOrdering\AbstractPostOrdering;

interface PostRepositoryInterface
{
    public function all(AbstractPostOrdering $postOrdering): \ArrayIterator;

    public function findOneById(string $slug, AbstractPostOrdering $postOrdering): ?Post;
}
