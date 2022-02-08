<?php

namespace Cript\BlogBundle\Context\User\Application\PostOrdering;

class ByDateDesc extends \SplPriorityQueue implements PostOrderingInterface
{
    public function getName(): string
    {
        return 'date_desc';
    }
}
