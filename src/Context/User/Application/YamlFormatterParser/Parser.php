<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Context\User\Application\YamlFormatterParser;

use Cript\BlogBundle\Context\User\Application\YamlFormatterParser\Exception\YamlFormatterParserException;

class Parser implements ParserInterface
{
    private const DIVIDER = '---';

    public function parse(\SplFileObject $fileObject): InfoInterface
    {
        if(self::DIVIDER !== $this->currentLine($fileObject)) {
            throw new YamlFormatterParserException();
        }

        $info = new Info();

        while (true) {
            $line = $this->nextLine($fileObject);

            if ($this->isLineDivider($line)) {
                break;
            }

            if ($fileObject->eof()) {
                throw new YamlFormatterParserException('Reach unexpected EOF');
            }

            $line = $this->parseLine($line);
            $info->add($line);
        }

        $this->validate($info);

        return $info;
    }

    private function currentLine(\SplFileObject $fileObject): string
    {
        return trim($fileObject->current());
    }

    private function nextLine(\SplFileObject $fileObject): string
    {
        $fileObject->next();
        return trim($fileObject->current());
    }

    private function isLineDivider(string $line): bool
    {
        return self::DIVIDER === $line;
    }

    private function parseLine(string $line): array
    {
        $line = preg_split("/[:]+/", $line, 2);

        if (2 !== count($line)) {
            throw new YamlFormatterParserException('Wrong YAML Formatter line');
        }

        return array_map('trim', $line);
    }

    private function validate(InfoInterface $info)
    {
        if (empty($info->title() || empty($info->date()) || empty($info->published()))) {
            throw new YamlFormatterParserException('Required fields have not been set');
        }
    }
}
