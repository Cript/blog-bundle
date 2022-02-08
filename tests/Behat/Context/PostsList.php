<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryBusInterface;
use Cript\BlogBundle\Context\User\Application\PostOrdering\Collection;
use Cript\BlogBundle\Context\User\Application\Query\GetAllPosts;
use Cript\BlogBundle\Context\User\Domain\Post;
use PHPUnit\Framework\TestCase;

class PostsList implements Context
{
    private array $posts;

    public function __construct(
        private QueryBusInterface $queryBus
    ) {}

    /**
     * @Given /^There are posts:$/
     */
    public function thereArePosts(TableNode $table)
    {
        // TODO:: create posts
        $this->posts = array_map(function ($post) {
            return array_merge($post, [
                'date' => new \DateTime($post['date']),
                'published' => '1' === $post['published']
            ]);
        }, $table->getColumnsHash());
    }

    /**
     * @When /^I load list of posts and I should receive (\d+) posts sorted by "([^"]*)"$/
     */
    public function iLoadListOfPostsAndIShouldReceivePostsSortedBy(int $arg1, string $ordering)
    {
        $expectedPosts = $this->getExpectedPosts($ordering);

        $query = new GetAllPosts($ordering);
        $posts = $this->queryBus->ask($query)->orderedByDate();

        TestCase::assertCount($arg1, $posts);
        $this->assertPosts($expectedPosts, $posts);
    }

    private function getExpectedPosts(string $ordering): array
    {
        // "date_desc" by default
        if (empty($ordering)) {
            return [$this->posts[1], $this->posts[0]];
        }

        $posts = [];

        switch ($ordering) {
            case 'date_desc':
                $posts[] = $this->posts[1];
                $posts[] = $this->posts[0];
                break;
            case 'date_asc':
                $posts[] = $this->posts[0];
                $posts[] = $this->posts[1];
                break;
        }

        return $posts;
    }

    private function assertPosts(array $expected, \ArrayIterator $posts)
    {
        foreach ($expected as $expectedKey => $expectedPost) {
            $this->assertPost($expectedPost, $posts[$expectedKey]);
        }
    }

    private function assertPost(array $expected, Post $post)
    {
        TestCase::assertEquals($expected['title'], $post->info()->title());
        TestCase::assertEquals($expected['slug'], $post->info()->slug());
        TestCase::assertEquals($expected['date'], $post->info()->date());
        TestCase::assertEquals($expected['published'], $post->info()->published());
    }
}
