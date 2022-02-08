<?php

namespace Cript\BlogBundle\Context\User\Application\Query;

use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryInterface;

class GetAllPosts implements QueryInterface
{
    public function __construct(
        private ?string $ordering = null
    ) {}

    public function ordering(): ?string
    {
        return $this->ordering;
    }
}
