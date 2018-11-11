<?php

use PHPUnit\Framework\TestCase;

use RealWorld\Domain\ArticleFactory;
use RealWorld\Domain\Entities\Article;
use RealWorld\Application\Query\GetArticleBySlug;
use RealWorld\Infrastructure\Repository\ArticleArrayRepository;

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

        $this->query = new GetArticleBySlug($repository);
    }

    public function testGetFooBarArticleBySlug()
    {
        $article = $this->query->handle('foobar');

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Foo Bar');
        $this->assertEquals($article->getSlug(), 'foobar');
        $this->assertEquals($article->getDescription(), 'Foo bar description.');
        $this->assertEquals($article->getBody(), 'Foo bar long text.');
    }

    public function testGetFizzBuzzArticleBySlug()
    {
        $article = $this->query->handle('fizzbuzz');

        $this->assertInstanceOf(Article::class, $article);
        $this->assertEquals($article->getTitle(), 'Fizz Buzz');
        $this->assertEquals($article->getSlug(), 'fizzbuzz');
        $this->assertEquals($article->getDescription(), 'Fizz buzz description.');
        $this->assertEquals($article->getBody(), 'Fizz buzz long text.');
    }

}
