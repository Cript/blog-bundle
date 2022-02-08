<?php

namespace Cript\BlogBundle\Context\User\Domain;

interface PostCollectionInterface
{
    public function add(Post $post);

    public function orderedByDate(): iterable;
}
