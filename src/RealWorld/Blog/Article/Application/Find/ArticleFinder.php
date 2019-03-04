<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Find;

use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQuery;
use RealWorld\Blog\Article\Domain\Exceptions\ArticleNotFoundException;
use RealWorld\Blog\Article\Infrastructure\Persistence\ArticleRepositoryArray;
use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleSlug;

final class ArticleFinder
{
    
    /** @var ArticleRepositoryArray */
    private $repository;
    
    public function __construct(ArticleRepositoryArray $repository)
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
        
        $article = $this->repository->searchBySlug($slug);
        
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