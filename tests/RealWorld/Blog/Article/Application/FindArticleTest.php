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

class FindArticleTest extends UnitTestCase
{

    /** @var callable */
    protected $query;

    public function setUp()
    {
        $fooBarArticle = ArticleFactory::createFromArray([
            'slug' => 'foobar',
            'title' => 'Foo Bar', 
            'description' => 'Foo bar description.', 
            'body' => 'Foo bar long text.',
        ]);

        $fizzBuzzArticle = ArticleFactory::createFromArray([
            'slug' => 'fizzbuzz',
            'title' => 'Fizz Buzz', 
            'description' => 'Fizz buzz description.', 
            'body' => 'Fizz buzz long text.',
        ]);
        
        $repository = new ArticleRepositoryArray([$fooBarArticle, $fizzBuzzArticle]);

        $finder = new ArticleFinder($repository);

        $this->query = new FindArticleBySlugQueryHandler($finder);
    }

    public function testGetFooBarArticleBySlug()
    {
        $slug = new ArticleSlug('foobar');

        $query = new FindArticleBySlugQuery($slug);

        $article = $this->ask($query, $this->query);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Foo Bar');
        $this->assertEquals($article->getSlug(), 'foobar');
        $this->assertEquals($article->getDescription(), 'Foo bar description.');
        $this->assertEquals($article->getBody(), 'Foo bar long text.');
    }

    public function testGetFizzBuzzArticleBySlug()
    {
        $slug = new ArticleSlug('fizzbuzz');

        $query = new FindArticleBySlugQuery($slug);

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
        
        $slug = new ArticleSlug('article-not-found');

        $query = new FindArticleBySlugQuery($slug);

        $article = $this->ask($query, $this->query);

        $this->assertNull($article);
    }

}
