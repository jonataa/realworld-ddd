<?php

declare(strict_types = 1);

namespace RealWorld\Article\Application\Find;

use RealWorld\Article\Application\Find\FindArticleBySlugQuery;
use RealWorld\Article\Domain\Exceptions\ArticleNotFoundException;
use RealWorld\Article\Infrastructure\Repository\ArticleRepository;
use RealWorld\Article\Domain\Entities\Article;
use RealWorld\Article\Domain\ArticleSlug;

final class ArticleFinder
{
    
    /** @var ArticleRepository */
    private $repository;
    
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
    * Finds Article by slug.
    *
    * @throws ArticleNotFoundException
    * 
    * @param FindArticleBySlugQuery $query
    * @return Article|null
    */  
    public function __invoke(FindArticleBySlugQuery $query): ?Article
    {
        $slug = $query->slug();
        
        $article = $this->repository->findOneBySlug($slug);
        
        $this->ensureArticleExists($slug, $article);
        
        return $article;
    }
    
    private function ensureArticleExists(ArticleSlug $slug, Article $article = null): void
    {
        if (null === $article) {
            throw new ArticleNotFoundException($slug);
        }
    }
    
}