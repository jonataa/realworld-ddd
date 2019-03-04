<?php

declare(strict_types = 1);

namespace RealWorld\Article\Infrastructure\Repository;

use RealWorld\Article\Domain\Entities\Article;
use RealWorld\Article\Domain\ArticleSlug;
use function Lambdish\phunctional\first;
use function Lambdish\Phunctional\filter;

class ArticleArrayRepository implements ArticleRepository
{
    
    /** @var Article[] */
    protected $rows = [];
    
    public function __construct(array $rows = [])
    {
        $this->rows = $rows;
    }
    
    public function findOneBySlug(ArticleSlug $slug): ?Article
    {
        $filtered = filter(function($article) use ($slug) {
            return $article->getSlug() === $slug->slug();
        }, $this->rows);
        
        return first($filtered);
    }
    
}