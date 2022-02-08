<?php

namespace Cript\BlogBundle\Context\User\Domain;

use Cript\BlogBundle\Context\User\Application\YamlFormatterParser\InfoInterface;

class Post
{
    public function __construct(
        private InfoInterface $info,
        private string $content
    ) {}

    public function info(): InfoInterface
    {
        return $this->info;
    }

    public function content(): string
    {
        return $this->content;
    }
}
