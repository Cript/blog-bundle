<?php

namespace Cript\BlogBundle\Context\User\Application\Query\Handler;

use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryHandlerInterface;
use Cript\BlogBundle\Context\User\Application\PostOrdering\Collection;
use Cript\BlogBundle\Context\User\Application\Query\GetAllPosts;
use Cript\BlogBundle\Context\User\Domain\PostCollectionInterface;
use Cript\BlogBundle\Context\User\Domain\PostRepositoryInterface;

class GetAllPostsHandler implements QueryHandlerInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private Collection $orderingCollection
    ) {}

    public function __invoke(GetAllPosts $query): PostCollectionInterface
    {
        $ordering = $this->orderingCollection->get($query->ordering());

        return $this->postRepository->all($ordering);
    }
}
