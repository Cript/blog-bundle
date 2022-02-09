<?php

namespace Cript\BlogBundle\Context\User\Application\Query\Handler;

use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryHandlerInterface;
use Cript\BlogBundle\Context\User\Application\PostOrdering\Collection;
use Cript\BlogBundle\Context\User\Application\Query\GetPost;
use Cript\BlogBundle\Context\User\Domain\Post;
use Cript\BlogBundle\Context\User\Domain\PostRepositoryInterface;

class GetPostHandler implements QueryHandlerInterface
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private Collection $orderingCollection
    ) {}

    public function __invoke(GetPost $query): ?Post
    {
        return $this->postRepository->findOneById($query->slug(), $this->orderingCollection->getDefault());
    }
}
