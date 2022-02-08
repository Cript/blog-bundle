<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Context\User\Domain;

use Cript\BlogBundle\Context\User\Application\PostOrdering\PostOrderingInterface;

interface PostRepositoryInterface
{
    public function all(PostOrderingInterface $postOrdering): PostCollectionInterface;
}
