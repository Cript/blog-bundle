<?php

namespace Cript\BlogBundle\Context\User\Application\PostOrdering;

abstract class AbstractPostOrdering extends \SplPriorityQueue implements PostOrderingInterface
{
    abstract public function getName(): string;
}
