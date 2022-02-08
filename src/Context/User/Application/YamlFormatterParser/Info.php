<?php

namespace Cript\BlogBundle\Context\User\Application\YamlFormatterParser;

class Info implements InfoInterface
{
    private string $title;
    private string $slug;
    private \DateTimeInterface $date;
    private bool $published;

    private const REQUIRED_PROPERTIES = [
        'title', 'slug', 'date', 'published'
    ];

    public function add(array $line)
    {
        if (in_array($line[0], self::REQUIRED_PROPERTIES, true)) {
            $methodName = sprintf('set%s', ucfirst($line[0]));

            $this->$methodName($line[1]);
        }
    }

    private function setTitle(string $title): void
    {
        $this->title = $title;
    }

    private function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    private function setDate(string $date): void
    {
        $this->date = new \DateTime($date);
    }

    private function setPublished(string $published): void
    {
        if ('1' === $published) {
            $this->published = true;
            return;
        }

        $this->published = false;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function date(): \DateTimeInterface
    {
        return $this->date;
    }

    public function published(): bool
    {
        return $this->published;
    }
}
