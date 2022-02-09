<?php

declare(strict_types=1);

namespace Cript\BlogBundle\Tests\Behat\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Cript\BlogBundle\Context\Shared\Application\Bus\Query\QueryBusInterface;
use Cript\BlogBundle\Context\User\Application\Query\GetPost;
use Cript\BlogBundle\Context\User\Domain\Post;
use PHPUnit\Framework\TestCase;

class MDPostShow implements Context
{
    private array $posts;
    private ?Post $post;

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
     * @When /^I load post with slug (.*)$/
     */
    public function iLoadPostWithSlug(string $slug)
    {
        $query = new GetPost($slug);
        $this->post = $this->queryBus->ask($query);
    }

    /**
     * @Then /^I should receive post with slug (.*)$/
     */
    public function iShouldReceivePostWithSlug(string $slug)
    {
        TestCase::assertEquals($slug, $this->post->info()->slug());
    }

    /**
     * @Then /^I should not receive post$/
     */
    public function iShouldNotReceivePost()
    {
        TestCase::assertNull($this->post);
    }
}
