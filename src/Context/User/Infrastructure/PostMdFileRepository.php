<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Context\User\Infrastructure;

use Cript\BlogBundle\Context\User\Application\ContentParser\ContentParserInterface;
use Cript\BlogBundle\Context\User\Application\PostFiltering\Published as PublishedFilter;
use Cript\BlogBundle\Context\User\Application\PostFiltering\Slug as SlugFilter;
use Cript\BlogBundle\Context\User\Application\PostOrdering\AbstractPostOrdering;
use Cript\BlogBundle\Context\User\Application\YamlFormatterParser\ParserInterface;
use Cript\BlogBundle\Context\User\Domain\Post;
use Cript\BlogBundle\Context\User\Domain\PostRepositoryInterface;
use Symfony\Component\Finder\Finder;

class PostMdFileRepository implements PostRepositoryInterface
{
    public function __construct(
        private string $postsPath,
        private ParserInterface $yamlFormatterParser,
        private ContentParserInterface $contentParser
    ) {}

    public function all(AbstractPostOrdering $postOrdering): \ArrayIterator
    {
        $finder = new Finder();

        $finder->files()
            ->depth('== 0')
            ->name('*.md')
            ->in($this->postsPath);

        if (!$finder->hasResults()) {
            return new \ArrayIterator();
        }

        foreach ($finder as $file) {
            $file = $file->openFile();

            $info = $this->yamlFormatterParser->parse($file);
            $content = $this->contentParser->parse($file);

            $post = new Post($info, $content);
            $postOrdering->insert($post, $post->info()->date());
        }

        $posts = new \ArrayIterator();

        while (!$postOrdering->isEmpty()) {
            $posts->append($postOrdering->extract());
        }

        $posts = (new PublishedFilter($posts));
        return new \ArrayIterator(iterator_to_array($posts));
    }

    public function findOneById(string $slug, AbstractPostOrdering $postOrdering): ?Post
    {
        $iterator = (new SlugFilter($this->all($postOrdering), $slug));
        $iterator->rewind();
        /**
         * @var Post $post
         */
        $post = $iterator->current();

        if (!$post) {
            return null;
        }

        if (!$post->info()->published()) {
            return null;
        }

        return $post;
    }
}
