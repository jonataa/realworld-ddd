<?php

use Test\RealWorld\Shared\Infrastructure\PHPUnit\UnitTestCase;
use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleId;
use RealWorld\Blog\Article\Domain\ArticleFactory;
use RealWorld\Blog\Article\Domain\ArticleSlugNotFound;
use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQueryHandler;
use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQuery;
use RealWorld\Blog\Article\Application\Find\ArticleFinder;
use RealWorld\Blog\Article\Infrastructure\Persistence\ArticleRepositoryArray;
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
        $this->assertEquals($article->title(), 'Foo Bar');
        $this->assertEquals($article->slug(), 'foobar');
        $this->assertEquals($article->description(), 'Foo bar description.');
        $this->assertEquals($article->body(), 'Foo bar long text.');
    }

    public function testGetFizzBuzzArticleBySlug()
    {
        $query = new FindArticleBySlugQuery('fizzbuzz');

        $article = $this->ask($query, $this->query);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->title(), 'Fizz Buzz');
        $this->assertEquals($article->slug(), 'fizzbuzz');
        $this->assertEquals($article->description(), 'Fizz buzz description.');
        $this->assertEquals($article->body(), 'Fizz buzz long text.');
    }

    public function testGetArticleNotFoundBySlug()    
    {
        $this->expectException(ArticleSlugNotFound::class);
        
        $query = new FindArticleBySlugQuery('article-not-found');

        $article = $this->ask($query, $this->query);

        $this->assertNull($article);
    }

}
