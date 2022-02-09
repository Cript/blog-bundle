<?php

namespace Cript\BlogBundle\Context\User\Application\PostFiltering;

use Iterator;

class Slug extends \FilterIterator
{
    private string $slug;

    public function __construct(Iterator $iterator, string $slug)
    {
        parent::__construct($iterator);

        $this->slug = $slug;
    }

    public function accept(): bool
    {
        $post = $this->current();

        if ($this->slug === $post->info()->slug()) {
            return true;
        }

        return false;
    }
}
