<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryBusInterface;
use Cript\BlogBundle\Context\User\Application\Query\GetAllPosts;
use Cript\BlogBundle\Context\User\Domain\Post;
use PHPUnit\Framework\TestCase;

class MDPostsList implements Context
{
    private array $posts;
    private \ArrayIterator $loadedPosts;

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
     * @When /^I load list of posts sorted by (.*)$/
     */
    public function iLoadListOfPostsSortedBy(string $ordering)
    {
        $query = new GetAllPosts($ordering);
        $this->loadedPosts = $this->queryBus->ask($query);
    }

    /**
     * @Then /^I should receive (.*) posts sorted by (.*)$/
     */
    public function iShouldReceivePostsSortedBy(int $posts_count, string $ordering)
    {
        $expectedPosts = $this->getExpectedPosts($ordering);
        TestCase::assertCount($posts_count, $this->loadedPosts);
        $this->assertPosts($expectedPosts, $this->loadedPosts);
    }

    private function getExpectedPosts(string $ordering): array
    {
        // "date_desc" by default
        if (empty($ordering)) {
            return [end($this->posts), $this->posts[0]];
        }

        $posts = [];

        switch ($ordering) {
            case 'date_desc':
                $posts[] = end($this->posts);
                $posts[] = reset($this->posts);
                break;
            case 'date_asc':
                $posts[] = reset($this->posts);
                $posts[] = end($this->posts);
                break;
        }

        return $posts;
    }

    private function assertPosts(array $expected, \ArrayIterator $posts)
    {
        foreach ($expected as $expectedKey => $expectedPost) {
            $posts->seek($expectedKey);
            $this->assertPost($expectedPost, $posts->current());
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
