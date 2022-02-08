<?php

namespace Cript\BlogBundle\Context\User\Domain;

use Ds\Collection;

class PostCollection implements PostCollectionInterface, Collection
{
    private \SplPriorityQueue $posts;

    public function __construct(\SplPriorityQueue $priorityQueue)
    {
        $this->posts = $priorityQueue;
    }

    public function add(Post $post)
    {
        $this->posts->insert($post, $post->info()->date());
    }

    public function clear()
    {
        $this->posts = new \SplPriorityQueue();
    }

    public function count(): int
    {
        return count($this->posts);
    }

    public function copy()
    {
        $postCollection = new PostCollection();

        foreach ($this->posts as $post) {
            $postCollection->add($post);
        }

        return $postCollection;
    }

    public function isEmpty(): bool
    {
        return empty($this->posts);
    }

    public function toArray(): array
    {
        return $this->posts;
    }

    public function jsonSerialize(): array
    {
        return [];
    }

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->posts);
    }

    public function orderedByDate(): iterable
    {
        $posts = new \ArrayIterator();

        while (!$this->posts->isEmpty()) {
            $posts->append($this->posts->extract());
        }

        return $posts;
    }
}
