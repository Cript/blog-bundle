<?php

namespace Cript\BlogBundle\Context\User\Application\ContentParser;

interface ContentParserInterface
{
    public function parse(\SplFileObject $file): string;
}
