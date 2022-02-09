<?php

namespace Cript\BlogBundle\Context\User\Application\PostFiltering;

class Published extends \FilterIterator
{
    public function accept(): bool
    {
        $post = $this->current();

        if ($post->info()->published()) {
            return true;
        }

        return false;
    }
}
