<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Context\User\Infrastructure;

use Cript\BlogBundle\Context\User\Application\ContentParser\ContentParserInterface;
use Cript\BlogBundle\Context\User\Application\PostOrdering\ByDateDesc;
use Cript\BlogBundle\Context\User\Application\PostOrdering\PostOrderingInterface;
use Cript\BlogBundle\Context\User\Application\YamlFormatterParser\ParserInterface;
use Cript\BlogBundle\Context\User\Domain\Post;
use Cript\BlogBundle\Context\User\Domain\PostCollection;
use Cript\BlogBundle\Context\User\Domain\PostCollectionInterface;
use Cript\BlogBundle\Context\User\Domain\PostRepositoryInterface;
use Symfony\Component\Finder\Finder;

class PostMdFileRepository implements PostRepositoryInterface
{
    public function __construct(
        private string $postsPath,
        private ParserInterface $yamlFormatterParser,
        private ContentParserInterface $contentParser
    ) {}

    public function all(PostOrderingInterface $postOrdering): PostCollectionInterface
    {
        $finder = new Finder();

        $finder->files()
            ->depth('== 0')
            ->name('*.md')
            ->in($this->postsPath);

        $collection = new PostCollection($postOrdering);

        if (!$finder->hasResults()) {
            return $collection;
        }

        foreach ($finder as $file) {
            $file = $file->openFile();

            $info = $this->yamlFormatterParser->parse($file);
            $content = $this->contentParser->parse($file);

            $collection->add(new Post($info, $content));
        }

        return $collection;
    }
}
