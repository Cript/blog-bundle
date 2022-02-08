<?php

namespace Cript\BlogBundle\Context\User\Application\PostOrdering;

use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class ByDateAsc extends \SplPriorityQueue implements PostOrderingInterface
{
    public function compare(mixed $priority1, mixed $priority2): int
    {
        if ($priority1 < $priority2) {
            return 1;
        }

        if ($priority1 > $priority2) {
            return 0;
        }

        return 0;
    }

    public function getName(): string
    {
        return 'date_asc';
    }
}
