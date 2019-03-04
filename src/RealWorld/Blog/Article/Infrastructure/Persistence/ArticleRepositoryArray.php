<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Infrastructure\Persistence;

use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Blog\Article\Domain\ArticleRepository;
use function Lambdish\phunctional\first;
use function Lambdish\Phunctional\filter;

class ArticleRepositoryArray implements ArticleRepository
{
    
    /** @var Article[] */
    protected $rows = [];
    
    public function __construct(array $rows = [])
    {
        $this->rows = $rows;
    }
    
    public function searchBySlug(ArticleSlug $slug): ?Article
    {
        $filtered = filter(function($article) use ($slug) {
            return $slug->slug() === $article->getSlug();
        }, $this->rows);
        
        return first($filtered);
    }
    
}