<?php

namespace Cript\BlogBundle\Context\User\Application\PostOrdering;

use Cript\BlogBundle\Context\User\Application\PostOrdering\Exception\PostOrderingException;

class Collection
{
    private array $sorters;

    public function __construct(iterable $sorters)
    {
        $this->sorters = $sorters instanceof \Traversable ? iterator_to_array($sorters) : $sorters;
    }

    public function exists(string $name): bool
    {
        return array_key_exists($name, $this->sorters);
    }

    public function get(?string $name)
    {
        if (empty($name)) {
            // TODO: move default ordering to config
            return $this->sorters['date_desc'];
        }

        if (!$this->exists($name)) {
            throw new PostOrderingException();
        }

        return $this->sorters[$name];
    }
}
