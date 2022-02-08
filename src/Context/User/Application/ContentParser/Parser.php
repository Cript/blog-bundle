<?php

namespace Cript\BlogBundle\Context\User\Application\ContentParser;

class Parser implements ContentParserInterface
{
    public function parse(\SplFileObject $file): string
    {
        $parsedown = new \Parsedown();
        $content = '';
        while (!$file->eof()) {
            $content .= $file->fgets();
        }

        return $parsedown->text($content);
    }
}
