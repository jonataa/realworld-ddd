<?php

use PHPUnit\Framework\TestCase;

use RealWorld\Domain\ArticleFactory;
use RealWorld\Domain\Entities\Article;
use RealWorld\Domain\Exceptions\ArticleNotFoundException;
use RealWorld\Application\Find\FindArticleBySlugQueryHandler;
use RealWorld\Application\Find\FindArticleBySlugQuery;
use RealWorld\Infrastructure\Repository\ArticleArrayRepository;
use RealWorld\Application\Find\ArticleFinder;

class GetArticleBySlugTest extends TestCase
{

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
        
        $repository = new ArticleArrayRepository([$fooBarArticle, $fizzBuzzArticle]);

        $finder = new ArticleFinder($repository);

        $this->query = new FindArticleBySlugQueryHandler($finder);
    }

    public function testGetFooBarArticleBySlug()
    {
        $command = new FindArticleBySlugQuery('foobar');

        $article = $this->query->handle($command);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Foo Bar');
        $this->assertEquals($article->getSlug(), 'foobar');
        $this->assertEquals($article->getDescription(), 'Foo bar description.');
        $this->assertEquals($article->getBody(), 'Foo bar long text.');
    }

    public function testGetFizzBuzzArticleBySlug()
    {
        $command = new FindArticleBySlugQuery('fizzbuzz');

        $article = $this->query->handle($command);

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Fizz Buzz');
        $this->assertEquals($article->getSlug(), 'fizzbuzz');
        $this->assertEquals($article->getDescription(), 'Fizz buzz description.');
        $this->assertEquals($article->getBody(), 'Fizz buzz long text.');
    }

    public function testGetArticleNotFoundBySlug()    
    {
        $this->expectException(ArticleNotFoundException::class);
        
        $command = new FindArticleBySlugQuery('article-not-found');

        $article = $this->query->handle($command);

        $this->assertNull($article);
    }

}
