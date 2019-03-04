<?php

use Test\RealWorld\Shared\Infrastructure\PHPUnit\UnitTestCase;
use RealWorld\Blog\Article\Domain\ArticleFactory;
use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\Exceptions\ArticleNotFoundException;
use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQueryHandler;
use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQuery;
use RealWorld\Blog\Article\Application\Find\ArticleFinder;
use RealWorld\Blog\Article\Infrastructure\Persistence\ArticleRepositoryArray;
use RealWorld\Blog\Article\Domain\ArticleId;
use RealWorld\Blog\ArticleAuthor\Domain\ArticleAuthorId;

class FindArticleTest extends UnitTestCase
{

    /** @var callable */
    protected $query;

    public function setUp()
    {
        $fooBarArticle = ArticleFactory::createFromArray([
            'id' => ArticleId::random()->value(),
            'slug' => 'foobar',
            'title' => 'Foo Bar', 
            'description' => 'Foo bar description.', 
            'body' => 'Foo bar long text.',
            'authorId' => ArticleAuthorId::random()->value(),
        ]);

        $fizzBuzzArticle = ArticleFactory::createFromArray([
            'id' => ArticleId::random()->value(),
            'slug' => 'fizzbuzz',
            'title' => 'Fizz Buzz', 
            'description' => 'Fizz buzz description.', 
            'body' => 'Fizz buzz long text.',
            'authorId' => ArticleAuthorId::random()->value(),
        ]);
        
        $repository = new ArticleRepositoryArray([$fooBarArticle, $fizzBuzzArticle]);

        $finder = new ArticleFinder($repository);

        $this->query = new FindArticleBySlugQueryHandler($finder);
    }

    public function testGetFooBarArticleBySlug()
    {
        $query = new FindArticleBySlugQuery('foobar');

        $article = $this->ask($query, $this->query);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Foo Bar');
        $this->assertEquals($article->getSlug(), 'foobar');
        $this->assertEquals($article->getDescription(), 'Foo bar description.');
        $this->assertEquals($article->getBody(), 'Foo bar long text.');
    }

    public function testGetFizzBuzzArticleBySlug()
    {
        $query = new FindArticleBySlugQuery('fizzbuzz');

        $article = $this->ask($query, $this->query);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Fizz Buzz');
        $this->assertEquals($article->getSlug(), 'fizzbuzz');
        $this->assertEquals($article->getDescription(), 'Fizz buzz description.');
        $this->assertEquals($article->getBody(), 'Fizz buzz long text.');
    }

    public function testGetArticleNotFoundBySlug()    
    {
        $this->expectException(ArticleNotFoundException::class);
        
        $query = new FindArticleBySlugQuery('article-not-found');

        $article = $this->ask($query, $this->query);

        $this->assertNull($article);
    }

}
