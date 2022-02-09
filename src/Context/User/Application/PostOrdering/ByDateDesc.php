<?php

namespace Cript\BlogBundle\Context\User\Application\PostOrdering;

class ByDateDesc extends AbstractPostOrdering
{
    public function getName(): string
    {
        return 'date_desc';
    }
}
