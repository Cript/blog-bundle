<?php

namespace Cript\BlogBundle\Context\User\Application\YamlFormatterParser;

interface InfoInterface
{
    public function add(array $line);
    public function title(): string;
    public function slug(): string;
    public function date(): \DateTimeInterface;
    public function published(): bool;
}
