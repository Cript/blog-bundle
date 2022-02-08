<?php

namespace Cript\BlogBundle\Context\User\Application\YamlFormatterParser;

interface ParserInterface
{
    public function parse(\SplFileObject $fileObject);
}
