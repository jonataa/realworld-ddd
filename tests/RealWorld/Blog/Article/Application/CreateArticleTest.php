<?php

use Test\RealWorld\Shared\Infrastructure\PHPUnit\UnitTestCase;
use RealWorld\Blog\Article\Domain\ArticleFactory;
use RealWorld\Blog\Article\Infrastructure\Persistence\ArticleRepositoryArray;
use RealWorld\Blog\Article\Application\Create\ArticleCreator;
use RealWorld\Blog\Article\Application\Create\CreateArticleHandler;
use RealWorld\Blog\Article\Application\Create\CreateArticleCommand;
use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQueryHandler;
use RealWorld\Blog\Article\Application\Find\ArticleFinder;
use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQuery;
use RealWorld\Blog\Article\Domain\ArticleSlug;

class CreateArticleTest extends UnitTestCase
{
  
  /** @var CreateArticleHandler */
  private $handler;

  public function setUp()
  {
    $empty = [];

    $repository = new ArticleRepositoryArray($empty);

    $creator = new ArticleCreator($repository);

    $this->handler = new CreateArticleHandler($creator);

    $finder = new ArticleFinder($repository);

    $this->query = new FindArticleBySlugQueryHandler($finder);
  }

  public function testCreateNewArticle()
  {
    $slug = new ArticleSlug('foo');

    $newArticle = ArticleFactory::createFromArray([
      'slug' => $slug->slug(),
      'title' => 'Foo Bar', 
      'description' => 'Foo bar description.', 
      'body' => 'Foo bar long text.',
    ]);

    $command = new CreateArticleCommand($newArticle);

    $this->dispatch($command, $this->handler);

    $query = new FindArticleBySlugQuery($slug);

    $this->ask($query, $this->query);

    $this->assertEquals($newArticle->getSlug(), $article->getSlug());
    $this->assertEquals($newArticle->getTitle(), $article->getTitle());
    $this->assertEquals($newArticle->getDescription(), $article->getDescription());
    $this->assertEquals($newArticle->getBody(), $article->getBody());
  }

}