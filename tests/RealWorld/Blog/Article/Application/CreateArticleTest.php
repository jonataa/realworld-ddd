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
use RealWorld\Blog\Article\Domain\ArticleId;
use RealWorld\Shared\Domain\ValueObject\Uuid;
use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;

class CreateArticleTest extends UnitTestCase
{
  
  /** @var callable */
  private $handler;

  /** @var callable */
  private $query;

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
    $commandId = Uuid::random();

    $id = ArticleId::random()->value();    
    $authorId = ArticleAuthorId::random()->value();

    $command = new CreateArticleCommand(
      $commandId,
      $id,
      'foobar',
      'Foo Bar',
      'Foo bar description.',
      'Foo bar long text.',
      $authorId
    );

    $this->dispatch($command, $this->handler);

    $query = new FindArticleBySlugQuery('foobar');

    $article = $this->ask($query, $this->query);

    $this->assertEquals($command->id(), $article->getId());
    $this->assertEquals($command->slug(), $article->getSlug());
    $this->assertEquals($command->title(), $article->getTitle());
    $this->assertEquals($command->description(), $article->getDescription());
    $this->assertEquals($command->body(), $article->getBody());
  }

}