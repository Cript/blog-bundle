<?php

namespace Cript\BlogBundle\Context\User\Application\Query;

use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryInterface;

class GetPost implements QueryInterface
{
    public function __construct(
        private string $slug
    ) {}

    public function slug(): ?string
    {
        return $this->slug;
    }
}
