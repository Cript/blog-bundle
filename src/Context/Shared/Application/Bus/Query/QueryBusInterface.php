<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Context\Shared\Application\Bus\Query;

interface QueryBusInterface
{
    public function ask(QueryInterface $query);
}
